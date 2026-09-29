<?php
// 9_loader_loading_bgsvg_excerpt: background: svg + excerpt game
// layout: loader(o) - background: svg - img - name - btn - loading_animation - excerpt game

$domain_url = \helper\options::options_by_key_type('base_url');
$domain_url = rtrim($domain_url, '/');
$site_name = \helper\options::options_by_key_type('site_name');
$theme_url = '/' . DIR_THEME;
$game = \helper\game::find_by_slug($slug);

if ($game->source_html != '') {
    if (strpos($game->source_html, 'gamedistribution')) {
        $domain_url = preg_replace('/([\/]+)$/', '', $domain_url);
        if (strpos($game->source_html, 'gd_sdk_referrer_url')) {
            $array_source = explode("gd_sdk_referrer_url", "$game->source_html");
            if (count($array_source) > 1) {
                $array_source[1] = 'gd_sdk_referrer_url=' . $domain_url . '/' . $game->slug . '.embed';
                $game->source_html = $array_source[0] . $array_source[1];
            }
        } else {
            $game->source_html = $game->source_html . '?gd_sdk_referrer_url=' . $domain_url . '/' . $game->slug . '.embed';
        }
    }
}
$game_name = $game->name;

// Các trang cần load game luôn: phần tử(url) phải bỏ "www." || đường dẫn phụ/con đi
$list_load_now = [
    'playminigames.net',
    'twoplayergames.org',
    'play-games.com',
    'wgplayground.com',
    'html5-games.io',
    'gamepix.com',
    'gamedistribution.com',
    'crazygames.com',
    'gameflare.com'
];
$check_load_now = check_list($list_load_now, $game->source_html);

// các trang có footer thấp == 35px (hide_footer: 38 - 45px => 41px)
$list_hide_footer_low = [
    'gameflare.com',
];
$check_hide_footer_low = check_list($list_hide_footer_low, $game->source_html);

// các trang không cần ẩn footer trên màn mobile
$list_not_hide_footer_mobi = [
    'crazygames.com',
];
$check_not_hide_footer_mobi = check_list($list_not_hide_footer_mobi, $game->source_html);

// Các trang phải chặn lấy referrer mới chơi được || bỏ được external link crazygames.com
$list_no_referrer = [
    'snokido.com',
    // 'crazygames.com',
];
$check_referrer = check_list($list_no_referrer, $game->source_html);
// in($check_load_now);

$game_type = $game->type;

function check_list($urls, $urlToCheck)
{
    $parsedUrl = parse_url($urlToCheck);
    if ($parsedUrl && isset($parsedUrl['host'])) {
        $host = $parsedUrl['host'];
        $found = false;
        foreach ($urls as $url) {
            if (strpos($host, $url) !== false) {
                $found = true;
                break;
            }
        }
        if ($found) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>

<?php if ($game) : ?>
    <html lang="en">

    <head>
        <title>Play <?php echo $game_name; ?> Game Online !</title>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow, noodp, noydir" />
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no, minimal-ui" />
        <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true,IE=Edge,chrome=1" />
        <meta http-equiv="Content-Language" content="en-US" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="<?php echo $site_name; ?>">
        <meta property="og:type" content="game">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <style type="text/css">
            html {
                height: 100%;
                box-sizing: border-box;
                font-size: 14px;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            *,
            *::before,
            *::after {
                box-sizing: inherit;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                font-family: 'Arial', Roboto, sans-serif;
                font-size: 16px;
                font-weight: 400;
                line-height: 1.43;
                background: #000;
                background-color: #000;
            }

            .iframe_game_wrap,
            .tesseract-game,
            .tesseract-splash-container {
                width: 100%;
                height: 100%
            }

            .tesseract-splash-container {
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
            }

            .game-bg {
                width: 100%;
                height: 100%;
                scale: 1.5;
                background-color: #fff;
            }

            .tesseract-splash-container {
                display: flex;
                flex-flow: column
            }

            .tesseract-splash-top {
                flex-flow: column;
                flex: 1
            }

            .tesseract-splash-bottom,
            .tesseract-splash-top {
                display: flex;
                box-sizing: border-box;
                align-self: center;
                justify-content: center
            }

            .tesseract-splash-game-thumbnail {
                flex-shrink: 0;
                border-radius: 16px;
                top: 30%;
                position: relative;
                margin: 0 auto
            }

            .tesseract-splash-title {
                top: 33%;
                color: #3b21cc;
                font-size: 1.6rem;
                font-weight: 700;
                text-transform: capitalize;
            }

            .tesseract-splash-title {
                margin: 0 auto;
                position: relative;
                text-align: center;
                leading-trim: both;
                text-edge: cap;
                font-style: normal;
                line-height: normal
            }

            .tesseract-splash-button {
                justify-content: center;
                align-items: center;
                position: relative;
                top: 37%;
                margin: 0 auto;
                flex-direction: row;
                width: 10rem;
                font-weight: 600;
                font-size: 16px;
                border-radius: 86.154px;
                background: #3b21cc !important;
                cursor: pointer;
                text-decoration: none;
                color: #eee;

            }

            .tesseract-splash-button>p {
                margin-left: 1rem;
            }

            .tesseract-loader,
            .tesseract-loader:after {
                border-radius: 50%;
                width: 1.5em;
                height: 1.5em
            }

            .tesseract-loader {
                top: 37%;
                margin: 0 auto;
                font-size: 10px;
                position: relative;
                text-indent: -9999em;
                border: 1.1em solid hsla(0, 0%, 100%, .2);
                border-left-color: #fff;
                -webkit-transform: translateZ(0);
                -ms-transform: translateZ(0);
                transform: translateZ(0);
                -webkit-animation: load8 1.1s linear infinite;
                animation: load8 1.1s linear infinite;
                display: none;
                box-sizing: unset
            }

            @-webkit-keyframes load8 {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            @keyframes load8 {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            .tesseract-splash-bottom {
                flex-flow: column;
                width: 100%;
                padding-left: 6px;
                padding-right: 6px;
                padding-bottom: 6px
            }

            .tesseract-splash-bottom>.tesseract-splash-consent {
                box-sizing: border-box;
                width: 100%;
                color: #fff;
                text-align: justify;
                font-size: 12px;
                font-weight: 400;
                line-height: 150%;
                padding: 10px 30px;
                left: 0;
                bottom: 0
            }

            .tesseract-splash-bottom>.tesseract-splash-consent a {
                color: #60bdea !important
            }

            .tesseract-splash-bottom>.tesseract-splash-consent a:active,
            .tesseract-splash-bottom>.tesseract-splash-consent a:hover {
                color: #9cdfff !important
            }

            /* hide_footer: 38px - 45px */
            body.hide_footer {
                height: calc(100% + 41px) !important;
                overflow: hidden !important;
            }

            <?php //gameflare.com
            if ($check_hide_footer_low) {
                echo 'body.hide_footer {
height: calc(100% + 35px) !important;
overflow: hidden !important;
}';
            }
            //crazygames.com
            if ($check_not_hide_footer_mobi) {
                echo '@media(max-width: 768px) {
body.hide_footer {
height: 100% !important;
overflow: unset !important;
}
}';
            } ?>
        </style>
    </head>

    <body>
        <div id="preloading-game" class="iframe_game_wrap">
            <svg class="game-bg" width="880" height="660" viewBox="0 0 880 660" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.2" d="M440.002 545.006C676.382 545.006 868.005 353.383 868.005 117.003C868.005 -119.376 676.382 -311 440.002 -311C203.623 -311 11.999 -119.376 11.999 117.003C11.999 353.383 203.623 545.006 440.002 545.006Z" fill="#DADADA" />
                <path opacity="0.3" d="M724.997 830.003C961.376 830.003 1153 638.38 1153 402C1153 165.62 961.376 -26.0032 724.997 -26.0032C488.617 -26.0032 296.994 165.62 296.994 402C296.994 638.38 488.617 830.003 724.997 830.003Z" fill="#DADADA" />
                <path opacity="0.4" d="M440.002 1115C676.382 1115 868.005 923.377 868.005 686.997C868.005 450.617 676.382 258.994 440.002 258.994C203.623 258.994 11.999 450.617 11.999 686.997C11.999 923.377 203.623 1115 440.002 1115Z" fill="#DADADA" />
                <path opacity="0.7" d="M155.003 830.003C391.383 830.003 583.006 638.38 583.006 402C583.006 165.62 391.383 -26.0032 155.003 -26.0032C-81.3765 -26.0032 -273 165.62 -273 402C-273 638.38 -81.3765 830.003 155.003 830.003Z" fill="#DADADA" />
            </svg>
            <div class="tesseract-splash-container">
                <div class="tesseract-splash-top">
                    <div class="tesseract-game">
                        <div class="tesseract-splash-game-thumbnail" style="width: 190px; height: 110px; background: url(&quot;<?php echo \helper\image::get_thumbnail($game->image, 190, 110, "m"); ?>&quot;) 0% 0% / cover;"></div>
                        <div class="tesseract-splash-title"><?php echo $game_name; ?></div>
                        <a id="btn_play" class="tesseract-splash-button" href="javascript:" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.2)' ?>" style="display: flex;" title="<?php echo $game_name; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                                <path d="M12.3067 0.692139C5.50672 0.692139 -0.000976562 6.19983 -0.000976562 12.9998C-0.000976562 19.7998 5.50672 25.3075 12.3067 25.3075C19.1067 25.3075 24.6144 19.7998 24.6144 12.9998C24.6144 6.19983 19.1067 0.692139 12.3067 0.692139ZM17.0267 15.6737L11.9036 18.6306C9.84518 19.8183 7.27287 18.3321 7.27287 15.9568V10.0429C7.27287 7.66752 9.84518 6.18137 11.9036 7.36906L17.0267 10.326C19.0852 11.5137 19.0852 14.486 17.0267 15.6737Z" fill="white"></path>
                            </svg>
                            <p>Play Now</p>
                        </a>
                        <div id="tesseract-loader" class="tesseract-loader" style="display: none;">Loading...</div>
                    </div>
                </div>
                <?php if ($game->excerpt) : ?>
                    <div class="tesseract-splash-bottom">
                        <div class="tesseract-splash-consent">
                            <p><?php echo $game->excerpt; ?></p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            document.addEventListener('DOMContentLoaded', function() {
                if (game_type != 'EXTERNAL' && check_load_now) {
                    start_game_frame();
                } else {
                    if (game_type == 'IFRAME_HTML') {
                        loading_game(0.9);
                    }
                }
            })

            function loading_game(duration) {
                if (document.getElementById("btn_play")) {
                    document.getElementById("tesseract-loader").style.display = 'block';
                    document.getElementById("btn_play").style.display = 'none';
                }
                setTimeout(() => {
                    start_game_frame();
                }, duration * 800); // 1000 convert (s)
            }

            // render tag iframe
            function start_game_frame() {
                let frame_game = document.createElement('iframe');
                frame_game.setAttribute('id', 'iframehtml5');
                frame_game.setAttribute('width', '100%');
                frame_game.setAttribute('height', '100%');
                frame_game.setAttribute('frameborder', '0');
                frame_game.setAttribute('border', '0');
                frame_game.setAttribute('scrolling', 'auto');
                frame_game.setAttribute('class', 'iframe-default');
                frame_game.setAttribute('allowfullscreen', 'true');
                frame_game.setAttribute('src', url_game);
                frame_game.setAttribute('title', "<?php echo $game_name ?>");
                frame_game.setAttribute('sandbox', 'allow-forms allow-modals allow-same-origin allow-scripts allow-pointer-lock');
                if (check_referrer) {
                    frame_game.setAttribute('referrerPolicy', 'no-referrer');
                }
                document.body.append(frame_game);

                if (game_type === 'HIDE_FOOTER') {
                    document.querySelector('body').className = "hide_footer";
                }
                if (document.getElementById("preloading-game")) {
                    document.getElementById("preloading-game").remove();
                }
            }

            // open url: external
            function openInNewWindow() {
                let height2 = window.innerHeight || 600;
                let width2 = window.innerWidth || 600;
                window.open(url_game, "", "width=" + width2 + ",height=" + height2);
            }
        </script>
    </body>

    </html>
<?php endif; ?>
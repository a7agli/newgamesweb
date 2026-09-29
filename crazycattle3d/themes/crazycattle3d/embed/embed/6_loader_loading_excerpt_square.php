<?php
// 6_loader_loading_excerpt_square: excerpt game + img square 
// layout: loader(...) - background: img - img square - btn - loading_animation - excerpt game

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
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Arial', Roboto, sans-serif;
            }

            html,
            body {
                width: 100%;
                height: 100%;
                background: #000;
                background-color: #000;
            }

            .overflow {
                overflow: hidden;
            }

            .game-page-loader {
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                flex: 1 1;
                width: 100%;
                height: 100%;
                background: #0a0a0a;
                border-radius: 20px 20px 0 0;
            }

            .page-loader {
                background: #000;
                bottom: 0;
                height: 100%;
                left: 0;
                position: absolute;
                right: 0;
                top: 0;
                width: 100%;
                z-index: 999
            }

            .page-loader-ball-container {
                left: 50%;
                margin-left: -40px;
                margin-top: -10px;
                position: absolute;
                text-align: center;
                top: 50%;
                width: 80px
            }

            .page-loader-ball-container .page-loader-ball-child {
                animation: loadThreeBounce 1.4s ease-in-out 0s infinite both;
                background-color: #fff;
                border-radius: 50%;
                display: inline-block;
                height: 20px;
                width: 20px
            }

            .page-loader-ball-container .page-loader-ball-0 {
                animation-delay: -.32s
            }

            .page-loader-ball-container .page-loader-ball-1 {
                animation-delay: -.16s
            }

            @keyframes loadThreeBounce {

                0%,
                80%,
                to {
                    transform: scale(0)
                }

                40% {
                    transform: scale(1)
                }
            }
        </style>

        <style>
            .talpa-splash-background-container {
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #000;
                overflow: hidden
            }

            .talpa-splash-background-image {
                box-sizing: border-box;
                position: absolute;
                top: -25%;
                left: -25%;
                width: 150%;
                height: 150%;
                background-image: var(--thumb);
                background-size: cover;
                filter: blur(50px) brightness(1.5)
            }

            .talpa-splash-container {
                display: flex;
                flex-flow: column;
                box-sizing: border-box;
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 100%
            }

            .talpa-splash-top {
                display: flex;
                flex-flow: column;
                box-sizing: border-box;
                flex: 1;
                align-self: center;
                justify-content: center;
                padding: 20px
            }

            .talpa-splash-top>div {
                text-align: center
            }

            .talpa-splash-top>div>button {
                position: relative;
                min-width: 180px;
                min-height: 45px;
                line-height: 45px;
                border: 0;
                border-radius: 25px;
                border-bottom: 5px solid grey;
                white-space: nowrap;
                text-overflow: ellipsis;
                text-align: center;
                text-transform: uppercase;
                text-shadow: 1px 1px 1px rgba(0, 0, 0, .004);
                font-family: Roboto Condensed, Helvetica Neue, Arial, "sans-serif";
                font-size: 16px;
                font-weight: 400;
                cursor: pointer;
                box-shadow: inset 0 -1px 1px hsla(0, 0%, 100%, .1), inset 0 1px 1px hsla(0, 0%, 100%, .2);
                will-change: transform;
                transition: transform .15s linear;
                z-index: 1;
            }

            /* .talpa-splash-top>div>button:focus {
                outline: none
            } */

            .talpa-splash-top>div>button:active {
                box-shadow: 0 10px 20px rgba(0, 0, 0, .19), 0 6px 6px rgba(0, 0, 0, .13);
                transform: translateY(-5px)
            }

            .talpa-splash-top>div>div:first-child {
                position: relative;
                width: 150px;
                height: 150px;
                margin: auto auto 20px;
                border-radius: 10px;
                overflow: hidden;
                border: 2px solid hsla(0, 0%, 100%, .8);
                box-shadow: inset 0 5px 5px rgba(0, 0, 0, .5), 0 2px 4px rgba(0, 0, 0, .3);
                background-image: var(--thumb);
                background-position: 50%;
                background-size: cover
            }

            .talpa-splash-top>div>div>img {
                width: 100%;
                height: 100%
            }

            .FG-splash-button {
                border-bottom-color: #ffb53d !important;
                color: #000;
                background: linear-gradient(140deg, #fbde04, #e2c803)
            }

            .FG-splash-button:hover {
                border-bottom-color: #ff5e00 !important;
                color: #fff;
                background: linear-gradient(140deg, #ff9214, #fa8500)
            }

            .FG-splash-button:active {
                border-bottom-color: #ff7e33 !important;
                background: linear-gradient(140deg, #ffa947, #ff9d2e)
            }

            .talpa-loader,
            .talpa-loader:after {
                border-radius: 50%;
                width: 1.5em;
                height: 1.5em
            }

            .talpa-loader {
                box-sizing: content-box;
                margin: 0 auto;
                font-size: 10px;
                position: relative;
                border: 1.1em solid hsla(0, 0%, 100%, .2);
                border-left-color: #fff;
                -webkit-transform: translateZ(0);
                -ms-transform: translateZ(0);
                transform: translateZ(0);
                -webkit-animation: talpa-load8 1.1s linear infinite;
                animation: talpa-load8 1.1s linear infinite;
                opacity: 0;
                margin-top: -26%;
            }

            @-webkit-keyframes talpa-load8 {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            @keyframes talpa-load8 {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            .talpa-splash-bottom {
                display: flex;
                flex-flow: column;
                box-sizing: border-box;
                align-self: center;
                justify-content: center;
                width: 100%;
                padding: 0 0 20px
            }

            .talpa-splash-bottom>.talpa-splash-consent,
            .talpa-splash-bottom>.talpa-splash-title {
                box-sizing: border-box;
                width: 100%;
                padding: 20px;
                background: linear-gradient(90deg, transparent, rgba(0, 0, 0, .5) 50%, transparent);
                color: #fff;
                text-align: left;
                font-size: 12px;
                font-family: Arial;
                font-weight: 400;
                text-shadow: 0 0 1px rgba(0, 0, 0, .7);
                line-height: 150%
            }

            .talpa-splash-bottom>.talpa-splash-title {
                padding: 15px 0;
                text-align: center;
                font-size: 18px;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: 700;
                line-height: 100%
            }

            .talpa-splash-bottom>.talpa-splash-consent a {
                color: #fff
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

    <body class="overflow">
        <div class="game-page-loader" id="game-page-loader">
            <div class="page-loader">
                <div class="page-loader-ball-container">
                    <div class="page-loader-ball-child page-loader-ball-0"></div>
                    <div class="page-loader-ball-child page-loader-ball-1"></div>
                    <div class="page-loader-ball-child page-loader-ball-2"></div>
                </div>
            </div>
        </div>

        <div id="preloading-game">
            <div class="talpa-splash-background-container">
                <div class="talpa-splash-background-image" style="--thumb: url(<?php echo $domain_url . \helper\image::get_thumbnail($game->image, 150, 150, 'm') ?>);"></div>
            </div>
            <div class="talpa-splash-container">
                <div class="talpa-splash-top">
                    <div>
                        <div style="--thumb: url(<?php echo $domain_url . \helper\image::get_thumbnail($game->image, 150, 150, 'm') ?>);"></div>
                        <button id="btn_play" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.2)' ?>"
                            class="FG-splash-button" title="<?php echo $game_name; ?>" aria-label="play game">play now!</button>
                        <div id="loading_css_animation" class="talpa-loader" style="opacity: 0;"></div>
                    </div>
                </div>
                <?php if ($game->excerpt) : ?>
                    <div class="talpa-splash-bottom">
                        <div class="talpa-splash-consent"><?php echo $game->excerpt ?></div>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            setTimeout(() => {
                if (document.getElementById("game-page-loader")) {
                    document.getElementById("game-page-loader").remove();
                    if (document.querySelector('body').className == "overflow") {
                        document.querySelector('body').classList.remove('overflow');
                    }
                }
            }, 330); // 1000 == (1s)

            document.addEventListener('DOMContentLoaded', function() {
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    start_game_frame();
                }
            })

            function loading_game(duration) {
                if (document.getElementById("btn_play")) {
                    document.getElementById("btn_play").style.opacity = 0;
                }
                document.getElementById("loading_css_animation").style.opacity = 1;

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
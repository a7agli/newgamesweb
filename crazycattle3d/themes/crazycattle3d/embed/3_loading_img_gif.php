<?php
// 3_loading_img_gif: background: linear-gradient(90deg, rgb(131, 94, 186) 0%, rgb(43, 62, 106) 100%);
// layout: img - btn - loading img gif
// CSS: có thể đổi màu nền và màu chữ (bỏ cmt là được): dòng 53 + 102

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
                font-family: "Helvetica Neue", "Calibri Light", Roboto, sans-serif;
            }

            html,
            body {
                background: #000;
                background-color: #000;
            }

            .preloading_box_wrap {
                position: relative !important;
            }

            .preloading_box {
                position: absolute;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, rgb(131, 94, 186) 0%, rgb(43, 62, 106) 100%);
                /* background: linear-gradient(90deg, #38508c 0%, rgb(43, 62, 106) 100%); */
                padding-top: 10%;
                text-align: center !important;
            }

            .iframe_img_wrap {
                margin-bottom: 40px !important;
                margin-top: 40px !important;
                /* min-height: 110px; */
            }

            img {
                vertical-align: middle;
                max-width: 100%;
                /* height: auto; */
                box-sizing: border-box;
            }

            p {
                margin: 0 0 20px 0;
                margin-top: 20px;
            }

            .iframe_img_loading {
                width: 100%;
                max-width: 350px;
            }

            .iframe_img {
                border-radius: 15px;
                box-shadow: 0 15px 11px -11px #000;
                /* max-height: 200px; */
            }

            #frame {
                height: 100%;
            }

            /* btn_play */
            .btn_play:hover {
                transform: scale(1.1);
                transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
            }

            .btn_play {
                display: inline-block;
                position: relative;
                padding: 13px 24px 13px 24px;
                color: #554d90;
                /* color: #ff7a00; */
                background-color: #fff;
                border-radius: 100px;
                border: 1px solid transparent;
                transform: perspective(1px) translateZ(0);
                transition-duration: 0.2s;
                font-family: 'Fredoka One', sans-serif;
                font-size: 21px;
                font-weight: 700;
                text-transform: capitalize;
                width: 100%;
                max-width: 167px;
                line-height: 25px;
                vertical-align: middle;
                cursor: pointer;
            }

            .MuiSvgIcon-root {
                fill: currentColor;
                width: 1em;
                height: 1em;
                display: inline-block;
                transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                flex-shrink: 0;
                user-select: none;
                animation: fss72 1.6s linear infinite;
                font-size: 1.3em;
                margin-left: 3px;
                margin-right: -9px;
                animation-delay: 0.2s;
                background-size: contain;
                vertical-align: middle;
            }

            @keyframes fss72 {
                0% {
                    opacity: 1;
                    transform: translateX(0px) scale(1);
                }

                25% {
                    opacity: 0;
                    transform: translateX(10px) scale(0.9);
                }

                26% {
                    opacity: 0;
                    transform: translateX(-10px) scale(0.9);
                }

                55% {
                    opacity: 1;
                    transform: translateX(0px) scale(1);
                }
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
        <div class="preloading_box_wrap" id="preloading-game">
            <div class="preloading_box">
                <div>
                    <p class="iframe_img_wrap">
                        <img width="238" height="140" class="iframe_img" src="<?php echo \helper\image::get_thumbnail($game->image, 238, 140, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                    </p>
                    <button id="btn_play" class="btn_play" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.5)' ?>" title="<?php echo $game_name; ?>" aria-label="play game">
                        Play Now
                        <svg class="MuiSvgIcon-root" width="1em" height="1em" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                        </svg>
                    </button>
                    <p id="loading_img_gif" style="display: none">
                        <picture class="loading">
                            <source srcset="<?php echo $theme_url ?>/embed/3.webp" type="image/webp">
                            <img class="iframe_img_loading" decoding="async" alt="loading" title="Paper.io game loading" width="350" height="44" loading="lazy" src="<?php echo $theme_url ?>/embed/3.webp">
                        </picture>
                    </p>
                </div>
            </div>
            <div id="frame"></div>
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
                        loading_game(1.5);
                    }
                }
            })

            function loading_game(duration) {
                if (document.getElementById("btn_play")) {
                    document.getElementById("btn_play").style.display = "none";
                }
                document.getElementById("loading_img_gif").style.display = "block";

                setTimeout(() => {
                    start_game_frame();
                }, duration * 900); // 1000 convert (s)
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
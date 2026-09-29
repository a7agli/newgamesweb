<?php
// 11_loader_dark: background: color + btn svg animation >
// layout: loader(...) - img - btn - name

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
        <!-- <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
        <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true,IE=Edge,chrome=1" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="<?php echo $site_name; ?>">
        <meta http-equiv="Content-Language" content="en-US" />
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
            .game-preloader {
                align-items: center;
                background: radial-gradient(#316883, #124056);
                background-color: #232333;
                box-sizing: border-box;
                color: #fff;
                display: flex;
                flex-direction: column;
                font-size: 16px;
                line-height: normal;
                height: 100%;
                justify-content: center;
                padding: 20px;
                text-align: center;
                width: 100%;
            }

            .game-preloader-image {
                margin-bottom: 25px;
            }

            .game-preloader-image .gameplayimg {
                border-radius: 10px;
                box-shadow: 0 0 12px rgb(0 0 0 / 30%);
            }

            .fss74:hover {
                transform: scale(1.1);
                transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
            }

            .fss74 {
                color: #3C1E6E;
                cursor: pointer;
                display: flex;
                padding: 13px 24px 13px 24px;
                position: relative;
                transform: perspective(1px) translateZ(0);
                align-items: center;
                font-family: 'Fredoka One', sans-serif;
                border-radius: 100px;
                text-transform: capitalize;
                justify-content: center;
                background-color: #35FDFF;
                transition-duration: 0.2s;
                font-size: 21px;
                border: none;
            }

            .MuiSvgIcon-root {
                fill: currentColor;
                width: 1em;
                height: 1em;
                display: inline-block;
                transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                flex-shrink: 0;
                user-select: none;
            }

            .fss73 {
                animation: fss72 1.6s linear infinite;
                font-size: 1.3em;
                margin-left: 4px;
                margin-right: -4px;
                animation-delay: 0.2s;
                background-size: contain;
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

            .game-preloader-website-name {
                background: linear-gradient(to right, rgba(30, 87, 153, 0) 0, rgba(0, 0, 0, .3) 50%, rgba(125, 185, 232, 0) 100%);
                margin-top: 40px;
                padding: 10px;
                text-align: center;
                color: white;
                opacity: 0.5;
                letter-spacing: 7px;
                text-transform: uppercase;
                font-size: 0.8571428571428571rem;
                font-family: Montserrat, Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-weight: 400;
                line-height: 1.66;
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

        <div id="preloading-game" class="game-preloader">
            <div class="game-preloader-image" onclick="startGame()">
                <img src="<?php echo \helper\image::get_thumbnail($game->image, 300, 166, 'm'); ?>" width="300" height="166" class="gameplayimg" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img">
            </div>
            <div class="MuiGrid-root fss18 MuiGrid-item" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'start_game_frame()' ?>">
                <button class="fss74" aria-label="play game">
                    Play Now
                    <svg class="MuiSvgIcon-root fss73" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                    </svg>
                </button>
            </div>
            <div class="game-preloader-website-name">&nbsp;<?php echo $game_name; ?>&nbsp;</div>
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
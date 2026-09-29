<?php
// 5_loading_svg: background: color
// layout: img - btn - svg loading - width loading

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
                background: #000;
                background-color: #000;
            }

            .splash-screen {
                align-items: center;
                background: linear-gradient(to bottom, #6a0dad, #37528c);
                background: linear-gradient(to bottom, #310a59, #37528c);
                display: flex;
                flex-direction: column;
                justify-content: center;
                inset: 0;
                position: absolute;
            }

            .logo {
                display: var(--logo-display, block);
                max-height: 150px;
                max-width: 380px;
                border-radius: 9px;
            }

            .name_game {
                color: #ffad33;
                color: #fff;
                color: #ffae36;
                font-size: 21px;
                font-weight: 700;
                margin-top: 15px;
                margin-bottom: 15px;
            }

            .loading-animation {
                aspect-ratio: 1;
                margin-bottom: 2%;
                max-height: 28px;
                max-width: 28px;
                margin-top: -33px;
            }

            .spinner {
                stroke-dasharray: 180;
                stroke-dashoffset: 135;
                stroke: #ffad33;
                animation: a 1.5s linear infinite;
                transform-origin: 50% 50%;
            }

            @keyframes a {
                to {
                    transform: rotate(1turn)
                }
            }

            .loadbar {
                background: #253559;
                background: #fff;
                height: 20%;
                max-height: 10px;
                max-width: 316px;
                width: 100%
            }

            .loadbar-inner {
                background: #ffad33;
                height: 100%;
                max-width: 100%;
                width: 0
            }


            /*  */
            .FG-splash-button {
                position: relative;
                min-width: 150px;
                min-height: 42px;
                line-height: 42px;
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
                font-weight: 500;
                cursor: pointer;
                box-shadow: inset 0 -1px 1px hsla(0, 0%, 100%, .1), inset 0 1px 1px hsla(0, 0%, 100%, .2);
                will-change: transform;
                transition: transform .15s linear;
                z-index: 1;
                border-bottom-color: #ffb53d !important;
                color: #000;
                background: linear-gradient(140deg, #fbde04, #e2c803);
            }

            .FG-splash-button:hover {
                border-bottom-color: #ff5e00 !important;
                color: #fff;
                background: linear-gradient(140deg, #ff9214, #fa8500)
            }

            .FG-splash-button:active {
                box-shadow: 0 10px 20px rgba(0, 0, 0, .19), 0 6px 6px rgba(0, 0, 0, .13);
                transform: translateY(-5px);
                border-bottom-color: #ff7e33 !important;
                background: linear-gradient(140deg, #ffa947, #ff9d2e);
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
        <div id="preloading-game" class="splash-screen" style="width: 100%; height: 100%;">
            <img width="238" height="140" class="logo" src="<?php echo \helper\image::get_thumbnail($game->image, 238, 140, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
            <br>
            <button id="btn_play" class="FG-splash-button" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game2(1.2)' ?>"
                title="<?php echo $game_name; ?>" aria-label="play game">play now!</button>

            <svg xmlns="http://www.w3.org/2000/svg" id="loading_animation" class="loading-animation" viewBox="0 0 66 66" style="opacity: 0">
                <circle xmlns="http://www.w3.org/2000/svg" class="spinner" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
            </svg>
            <div id="loadbar" class="loadbar" style="opacity: 0">
                <div class="loadbar-inner"></div>
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
                        loading_game2(1.2);
                    }
                }
            })

            function loading_game(duration) {
                const loadbar = document.getElementById('loadbar');
                let currentCount = 0; // Start at 0

                document.getElementById("loading_animation").style.opacity = 1;
                document.getElementById("loadbar").style.opacity = 1;

                function animate() {
                    const startTime = performance.now(); // Get start time

                    function updateProgress() {
                        const elapsedTime = (performance.now() - startTime) / 1000; // Time in seconds
                        const progress = Math.min(elapsedTime / duration, 2); // Progress (0 to 1)
                        currentCount = Math.floor(progress * 21); // Calculate current count (0 to 21)
                        loadbar.style.width = `${currentCount}%`;

                        if (currentCount < 28) {
                            requestAnimationFrame(updateProgress); // Update again if not finished
                        }
                    }
                    updateProgress();
                }
                requestAnimationFrame(animate);
            }

            function loading_game2(duration) {
                if (document.getElementById("btn_play")) {
                    document.getElementById("btn_play").style.opacity = 0;
                }
                loading_game(duration);

                setTimeout(() => {
                    start_game_frame();
                }, duration * 1000); // 1000 convert (s)
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
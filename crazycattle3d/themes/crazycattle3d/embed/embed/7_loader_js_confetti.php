<?php
// 7_loader_js_confetti: btn anmation up down
// layout: loader(... 390s) - background: linear-gradient - img - name game - btn

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
                overflow: hidden;
                background: #000;
                background-color: #000;
            }

            /* pre loader */
            .game-page-loader {
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

            /* iframe game */
            .iframe_game {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background: linear-gradient(to bottom, #6a0dad, #310a59);
                overflow: hidden;
            }

            .container {
                text-align: center;
                position: relative;
                z-index: 10;
                color: white;
            }

            .crown {
                animation: float 2s ease-in-out infinite;
            }

            h1 {
                font-size: 33px;
                font-weight: bold;
                color: #ffb733;
                margin-bottom: 20px;
                margin-top: 20px;
                text-transform: capitalize;
            }

            .label {
                font-size: 18px;
                color: rgba(255, 255, 255, 0.6);
                margin-bottom: 10px;
            }

            .score {
                font-size: 64px;
                font-weight: bold;
                margin-bottom: 40px;
            }

            /*  */
            .play-button {
                background-color: #ffb733;
                border: none;
                border-radius: 12px;
                padding: 8px;
                cursor: pointer;
                box-shadow: 0 5px 0 #d19328;
                transition: all 0.2s;
                max-width: 100%;
                width: 132px;
            }

            .play-button:active {
                box-shadow: none;
                transform: translateY(5px);
            }

            .play-icon {
                font-size: 32px;
                color: white;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            /* confetti */
            .confetti-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 1;
            }

            .confetti {
                position: absolute;
                width: 10px;
                height: 10px;
                background-color: #f2a900;
                opacity: 0.7;
                animation: confetti-fall 3s linear infinite;
                border-radius: 50%;
            }

            @keyframes confetti-fall {
                0% {
                    transform: translateY(-100vh) rotate(0deg);
                    opacity: 1;
                }

                100% {
                    transform: translateY(100vh) rotate(360deg);
                    opacity: 0;
                }
            }

            .logo {
                display: var(--logo-display, block);
                max-height: 150px;
                max-width: 380px;
                border-radius: 9px;
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
        <div class="game-page-loader" id="game-page-loader">
            <div class="page-loader">
                <div class="page-loader-ball-container">
                    <div class="page-loader-ball-child page-loader-ball-0"></div>
                    <div class="page-loader-ball-child page-loader-ball-1"></div>
                    <div class="page-loader-ball-child page-loader-ball-2"></div>
                </div>
            </div>
        </div>

        <div id="preloading-game" class="iframe_game">
            <div class="confetti-container"></div>
            <div class="container">
                <div style="display: flex;justify-content: center;"><!-- 👑 -->
                    <img width="238" height="140" class="logo" src="<?php echo \helper\image::get_thumbnail($game->image, 238, 140, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                </div>
                <h1><?php echo $game_name; ?></h1>
                <button class="crown play-button" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'start_game_frame()' ?>" title="Play <?php echo $game_name; ?>" aria-label="play game">
                    <div class="play-icon">▶</div>
                </button>
            </div>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            // loader
            setTimeout(() => {
                if (document.getElementById("game-page-loader")) {
                    document.getElementById("game-page-loader").remove();
                }
            }, 390); // 1000 == (1s)

            document.addEventListener('DOMContentLoaded', function() {
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    start_game_frame();
                }

                if (confettiContainer) {
                    setInterval(createConfetti, 300);
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

            // ============ confetti ==========
            const confettiContainer = document.querySelector('.confetti-container');
            const confettiColors = ['#ffb733', '#ff6f61', '#72e5a6', '#f1c40f', '#e74c3c', '#3498db'];

            function createConfetti() {
                const confetti = document.createElement('div');
                confetti.classList.add('confetti');
                confetti.style.left = `${Math.random() * 100}vw`;
                confetti.style.backgroundColor = confettiColors[Math.floor(Math.random() * confettiColors.length)];
                confetti.style.animationDuration = `${Math.random() * 3 + 2}s`; // Random time down

                confettiContainer.appendChild(confetti);

                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
            // setInterval(createConfetti, 200);
        </script>
    </body>

    </html>
<?php endif; ?>
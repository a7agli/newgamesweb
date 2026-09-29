<?php
// 24_loader_blur_x2: background: img blur black + loader css
// layout: background img blur black - img - name - btn - loader css

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
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="<?php echo $site_name; ?>">
        <meta http-equiv="Content-Language" content="en-US" />
        <meta property="og:type" content="game">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Helvetica, Arial, Roboto, sans-serif;
            }

            html,
            body {
                width: 100%;
                height: 100%;
                background: #000;
                background-color: #000;
                overflow: hidden;
            }

            .game-container {
                position: relative;
                background: #444;
            }

            .game-splash {
                position: relative;
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                color: #fff;
                text-align: center;
                padding: 50px
            }

            @media screen and (max-width:992px) {
                .game-splash {
                    padding: 20px
                }
            }

            .game-splash-background {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                /* background-size: cover; */
                filter: blur(45px);
                z-index: 1
            }

            .game-thumbnail {
                max-width: 100%;
                max-height: 100%;
                object-fit: cover;
                border-radius: 10px !important;
                margin-bottom: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, .3) !important;
                z-index: 2
            }

            .game-splash .title {
                margin-bottom: 20px;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, .7);
                color: #fff;
                font-size: 40px;
                font-weight: 700;
                text-transform: capitalize;
                z-index: 2
            }

            .game-splash-content {
                background: rgba(255, 255, 255, .4);
                border-radius: 50px;
                display: block;
                width: 100%;
                height: 100%;
                z-index: 10;
                box-shadow: 0px 0px 0px 0px #fff, 10px 20px 21px rgba(0, 0, 0, .4);
                position: relative;
                transition: box-shadow .2s
            }

            .game-splash-content-center {
                display: grid;
                width: 100%;
                height: 100%;
                grid-template-columns: 1fr;
                box-sizing: border-box;
                place-items: center
            }

            .play-button {
                padding: 12px 24px;
                font-size: 18px;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color .3s;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                z-index: 2
            }

            .play-button:hover {
                background-color: #45a049
            }

            .play-button svg {
                font-size: 1.71429rem;
                fill: #fff;
                width: 1em;
                height: 1em
            }

            .game-iframe {
                display: none;
                width: 100%;
                height: 600px;
                border: 0
            }

            /* loader */
            .gamePlayerLoadingAnim {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 100000000;
                /* background: rgba(0, 0, 0, .70); */
                background: #000;
            }

            .gamePlayerLoadingAnim div {
                box-sizing: border-box;
                display: block;
                position: absolute;
                width: 64px;
                height: 64px;
                margin: 4px;
                animation: gamePlayerLoadingAnim 1s infinite;
                border-style: solid;
                border-color: #fff transparent transparent transparent;
                border-width: 3px;
                border-radius: 50%;
            }

            .gamePlayerLoadingAnim div:nth-child(1) {
                animation-delay: -0.9s;
            }

            .gamePlayerLoadingAnim div:nth-child(2) {
                animation-delay: -0.8s;
            }

            .gamePlayerLoadingAnim div:nth-child(3) {
                animation-delay: -0.1s;
            }

            @keyframes gamePlayerLoadingAnim {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .gamePlayerLoadingAnim span {
                font-family: 'roboto', sans-serif;
                width: 100%;
                text-align: center;
                color: #fff;
                padding-top: 150px;
                position: absolute;
                z-index: 99999999999999999999;
            }

            .gamePlayerHidden {
                display: none !important;
                visibility: hidden;
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
        <?php if ($game_type === 'EXTERNAL' || ($game_type !== 'IFRAME_HTML'  && $check_load_now === false)) : ?>
            <div id="preloading-game" class="game-container">
                <div class="game-splash">
                    <div class="game-splash-background" style="background-image: url(<?php echo \helper\image::get_thumbnail($game->image, 500, 300, "m"); ?>);"></div>
                    <div class="game-splash-content">
                        <div class="game-splash-content-center">
                            <div>
                                <img class="game-thumbnail" src="<?php echo \helper\image::get_thumbnail($game->image, 200, 113, "m"); ?>" width="200" height="113" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?>">
                                <div class="title"><?php echo $game_name; ?></div>
                                <button class="play-button" onclick="<?php echo ($game_type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.2)' ?>" aria-label="Play Game">Play Game
                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-14yq2cq" focusable="false" aria-hidden="true" viewBox="0 0 24 24" width="24" height="24">
                                        <path d="M10 15.0657V8.93426C10 8.53491 10.4451 8.29671 10.7773 8.51823L15.376 11.584C15.6728 11.7819 15.6728 12.2181 15.376 12.416L10.7774 15.4818C10.4451 15.7033 10 15.4651 10 15.0657Z"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 15.0657V8.93426C9.5 8.13556 10.3901 7.65917 11.0547 8.10221L15.6533 11.1679C16.247 11.5638 16.247 12.4362 15.6533 12.8321L11.0547 15.8978C10.3901 16.3408 9.5 15.8644 9.5 15.0657ZM10 8.93426V15.0657C10 15.4651 10.4451 15.7033 10.7774 15.4818L15.376 12.416C15.6728 12.2181 15.6728 11.7819 15.376 11.584L10.7773 8.51823C10.4451 8.29671 10 8.53491 10 8.93426Z"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div id="loading_wrap" class="gamePlayerLoadingAnim gamePlayerHidden">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <span>Game will resume momentarily...</span>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            document.addEventListener('DOMContentLoaded', function() {
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    loading_game(1.2)
                }
            })

            function loading_game(duration) {
                start_game_frame()

                if (document.getElementById('loading_wrap')) {
                    document.getElementById('loading_wrap').classList.remove('gamePlayerHidden');
                }

                setTimeout(() => {
                    if (document.getElementById('loading_wrap')) {
                        document.getElementById('loading_wrap').remove();
                    }
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
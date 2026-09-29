<?php
// 15_loading_blur_dark: background: img 
// layout: img - name - btn - loading (o)2

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
            }

            .game-preview {
                width: 100%;
                height: 100%;
                overflow: hidden;
            }

            .game-preview-bgi {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10;
                background-position: center;
                background-size: cover;
                filter: blur(50px);
            }

            .game-preview__content {
                position: relative;
                z-index: 20;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .game-preview__logo img {
                height: auto;
                max-width: 100%;
                border-radius: 8px;
                -webkit-box-shadow: 0 0 1rem 0 #fff;
                box-shadow: 0 0 1rem 0 #fff;
            }

            .game-preview__title {
                font-size: 24px;
                color: #fff;
                font-weight: bold;
                margin: 20px auto;
                background: linear-gradient(90deg, rgba(30, 87, 153, 0) 0, rgba(0, 0, 0, .3) 50%, rgba(125, 185, 232, 0));
                width: 100%;
                text-align: center;
                padding: 14px;
                font-family: inherit;
                text-transform: capitalize;
            }

            .play-btn {
                position: relative;
                display: inline-block;
                vertical-align: top;
            }

            .play-btn__ctrl {
                overflow: hidden;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                position: relative;
                z-index: 10;
                box-shadow: 0 0 1rem 0 #fff;
                background: #FF3814;
                font-weight: 700;
                color: #fff;
                height: 50px;
                font-size: 22px;
                padding: 0 32px;
                border-radius: 16px;
                border: 0;
                margin: 0;
                cursor: pointer;
                -webkit-overflow-scrolling: touch;
                transition: box-shadow ease .15s, background-color ease .15s, transform ease .1s, opacity ease .1s;
            }

            .play-btn__ctrl:before {
                content: "";
                position: absolute;
                height: 30px;
                left: 50%;
                width: 50px;
                margin-left: -25px;
                top: 45px;
                z-index: 0;
                border-radius: 10px;
                background-color: #ffffff;
            }
        </style>

        <style>
            .GamePlayer__Overlay {
                display: flex;
                align-items: center;
                justify-content: center;
                position: absolute;
                pointer-events: none;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 30;
                background: #000;
            }

            .GamePlayer__Loader {
                pointer-events: auto;
                margin: 0;
                padding: 0;
                border: 0;
                font: inherit;
                vertical-align: baseline;

                font-size: 500%;
                animation: spinAround .5s linear infinite;
                border-radius: 9999px;
                border-color: transparent transparent hsla(0, 0%, 100%, .85) hsla(0, 0%, 100%, .85);
                border-style: solid;
                border-width: .125em;
                content: "";
                display: block;
                height: 1em;
                position: relative;
                width: 1em;
            }

            @keyframes spinAround {
                0% {
                    transform: rotate(0deg)
                }

                to {
                    transform: rotate(359deg)
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
        <div id="game-page-loader" class="GamePlayer__Overlay" style="display: none;">
            <div class="GamePlayer__Loader"></div>
        </div>

        <div id="preloading-game" class="game-preview">
            <div class="game-preview-bgi" style="background-image: url('<?php echo \helper\image::get_thumbnail($game->image, 230, 140, 'm'); ?>')"></div>
            <div class="game-preview__content">
                <div class="game-preview__logo">
                    <img src="<?php echo \helper\image::get_thumbnail($game->image, 230, 140, 'm'); ?>" width="230" height="140" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img">
                </div>
                <div class="game-preview__title"><?php echo $game_name; ?></div>
                <div class="game-preview__run">
                    <div class="play-btn">
                        <button class="play-btn__ctrl" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(0.7)' ?>"
                            title="<?php echo $game_name; ?>" aria-label="play game">Play</button>
                    </div>
                </div>
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
                        loading_game(0.7);
                    }
                }
            })

            function loading_game(duration) {
                if (document.getElementById("game-page-loader")) {
                    document.getElementById("game-page-loader").style.display = 'flex';
                    if (document.getElementById("preloading-game")) {
                        document.getElementById("preloading-game").remove();
                    }
                }
                setTimeout(() => {
                    start_game_frame();
                    if (document.getElementById("game-page-loader")) {
                        document.getElementById("game-page-loader").remove();
                    }
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
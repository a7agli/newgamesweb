<?php
// 13_loading_dark_square: background: img + img square
// layout: bg:img - img - btn - orther html loading (...)

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

            .playbutton {
                position: sticky;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                width: 100%;
                height: 100%;
                background: #181818;
                border: 1px solid #383b3e;
                border-radius: 5px;
            }

            .playbutton:before {
                content: " ";
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                box-sizing: border-box;
                background-image: url(<?php echo $domain_url . \helper\image::get_thumbnail($game->image, 180, 180, 'm'); ?>);
                background-repeat: no-repeat;
                background-size: cover;
                filter: blur(30px) brightness(0.6);
                z-index: -1;
            }

            .playnowtext {
                font-size: 50px;
                color: white;
                display: contents;
                cursor: pointer;
                padding: 30px 10px;
                font-weight: 700;
            }

            .ptb img {
                border-radius: 100px;
                margin-top: 20px;
                border: 3px solid #000000;
            }

            .btnplaynow {
                background-color: #000000;
                border: 1px solid #333333;
                border-radius: 10px;
                margin-left: 10px;
                padding: 10px;
                font-size: 50px;
                color: white;
                font-weight: 700;
                cursor: pointer;
            }

            .btnplaynow:hover {
                box-shadow: inset 400px 0 0 0 #3e8e41;
            }
        </style>

        <style>
            .loading-container {
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background-color: rgba(0, 0, 0, 1);
                color: rgba(255, 255, 255, 1);
            }

            .loading-container .loading-image {
                margin-right: -4rem;
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
        <div id="game-page-loader" style="display: none" class="loading-container">
            <span>Loading...</span>
            <div class="el-image loading-image el-image__inner">
                <br>
                <svg width="700px" height="76px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 100" preserveAspectRatio="xMidYMid" class="lds-pacman">
                    <g ng-attr-style="display:{{config.showBean}}" style="display:block">
                        <rect x="162" y="44" width="14" height="14" rx="5" ry="5" ng-attr-fill="{{config.c2}}" fill="#fff">
                            <animate attributeName="x" calcMode="linear" values="190;20" keyTimes="0;1" dur="1.5s" begin="-1.2s" repeatCount="indefinite"></animate>
                            <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1.5s" begin="-1.2s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="132" y="44" width="14" height="14" rx="5" ry="5" ng-attr-fill="{{config.c2}}" fill="#fff">
                            <animate attributeName="x" calcMode="linear" values="190;20" keyTimes="0;1" dur="1.5s" begin="-0.9s" repeatCount="indefinite"></animate>
                            <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1.5s" begin="-0.9s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="102" y="44" width="14" height="14" rx="5" ry="5" ng-attr-fill="{{config.c2}}" fill="#fff">
                            <animate attributeName="x" calcMode="linear" values="190;20" keyTimes="0;1" dur="1.5s" begin="-0.6s" repeatCount="indefinite"></animate>
                            <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1.5s" begin="-0.6s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="72" y="44" width="14" height="14" rx="5" ry="5" ng-attr-fill="{{config.c2}}" fill="#fff">
                            <animate attributeName="x" calcMode="linear" values="190;20" keyTimes="0;1" dur="1.5s" begin="-0.3s" repeatCount="indefinite"></animate>
                            <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1.5s" begin="-0.3s" repeatCount="indefinite"></animate>
                        </rect>
                        <rect x="42" y="44" width="14" height="14" rx="5" ry="5" ng-attr-fill="{{config.c2}}" fill="#fff">
                            <animate attributeName="x" calcMode="linear" values="190;20" keyTimes="0;1" dur="1.5s" begin="0s" repeatCount="indefinite"></animate>
                            <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1.5s" begin="0s" repeatCount="indefinite"></animate>
                        </rect>
                    </g>
                    <g ng-attr-transform="translate({{config.showBeanOffset}} 0)" transform="translate(-15 0)">
                        <path d="M50 50L20 50A30 30 0 0 0 80 50Z" ng-attr-fill="{{config.c1}}" fill="#ffff00" transform="rotate(16.875 50 50)">
                            <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;45 50 50;0 50 50" keyTimes="0;0.5;1" dur="0.5s" begin="0s" repeatCount="indefinite"></animateTransform>
                        </path>
                        <path d="M50 50L20 50A30 30 0 0 1 80 50Z" ng-attr-fill="{{config.c1}}" fill="#ffff00" transform="rotate(-16.875 50 50)">
                            <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-45 50 50;0 50 50" keyTimes="0;0.5;1" dur="0.5s" begin="0s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                </svg>
            </div>
        </div>

        <div id="preloading-game" class="playbutton">
            <div class="playnowtext" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1)' ?>">
                <div class="ptb">
                    <img src="<?php echo \helper\image::get_thumbnail($game->image, 180, 180, 'm'); ?>" width="180" height="180" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> background">
                </div>
                <button class="btnplaynow" title="<?php echo $game_name; ?>" aria-label="play game">► Play Now!</button>
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
                        loading_game(1);
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
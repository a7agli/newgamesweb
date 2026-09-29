<?php
// 17_loader_blur_dark: background: img + btn animation
// layout: background: img - img - btn animation - name

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

            .loader_svg {
                position: relative;
                width: 100%;
                height: 100%;
                background-color: #f2f6fa;
                overflow: hidden;
            }

            .loader_svg svg {
                vertical-align: middle;
                display: inline-block;
                height: 230px;
                left: 50%;
                margin: -115px 0 0 -80px;
                position: absolute;
                top: 50%;
                width: 230px;
            }

            /* iframe */
            .game-splash-screen {
                position: relative;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .game-splash-screen:before {
                content: " ";
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                filter: blur(50px);
                background-image: url(<?php echo \helper\image::get_thumbnail($game->image, 255, 200, "m"); ?>);
                background-repeat: no-repeat;
                background-size: cover;
            }

            .game-splash-screen .row {
                position: relative;
                top: 50%;
                transform: translateY(-50%);
                -webkit-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
            }

            .text-center {
                text-align: center;
            }

            .img-thumbnail {
                display: block;
                max-width: 100%;
                height: auto;
                margin: 0 auto -10px;
                background-color: #fff;
                border: 5px solid #fff;
                border-radius: 5%;
                box-shadow: 4px 2px 30px #505050;
                line-height: 1.42857143;
                transition: all .2s ease-in-out;
                vertical-align: middle;
            }

            .btn-danger {
                position: relative;
                display: inline-block;
                padding: 10px 21px;
                white-space: nowrap;
                text-align: center;
                border-color: #d43f3a;
                border-radius: 6px;
                border: 3px solid #fff;
                color: #fff;
                background: linear-gradient(#f94f4a, #bf302c);
                font-size: 21px;
                font-weight: 700;
                line-height: 1.3333333;
                text-shadow: 1px 1px #505050;
                text-transform: uppercase;
                transition: all .2s;
                cursor: pointer;
                vertical-align: middle;
                touch-action: manipulation;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            .btn-danger:after {
                content: "»";
                opacity: 0;
                position: absolute;
                right: 5px;
                transition: .5s;
            }

            .btn-danger:hover {
                background: linear-gradient(#bf302c, #bf302c);
                padding-right: 40px;
            }

            .btn-danger:hover:after {
                opacity: 1;
                right: 15px;
            }

            .title {
                margin-top: 60px;
                padding: 15px;
                background: linear-gradient(90deg, rgba(30, 87, 153, 0) 0, rgba(0, 0, 0, .3) 50%, rgba(125, 185, 232, 0));
                color: #fff;
                font-size: 23px;
                font-weight: 700;
                letter-spacing: -1px;
                text-align: center;
                text-shadow: 1px 1px #505050;
                text-transform: capitalize;
            }

            @media (max-width: 500px) {
                .btn-danger {
                    padding: 6px 12px;
                    font-size: 16px;
                }

                .title {
                    margin-top: 10px;
                }
            }

            .overflow {
                overflow: hidden;
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
        <div id="game-page-loader" class="loader_svg">
            <svg width="230px" height="230px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-pacman" style="background: none;">
                <g ng-attr-style="display:{{config.showBean}}" style="display:block">
                    <circle cx="80.8" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#ab73d2">
                        <animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="1" begin="-0.67s" repeatCount="indefinite"></animate>
                        <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1" begin="-0.67s" repeatCount="indefinite"></animate>
                    </circle>
                    <circle cx="41.2" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#ab73d2">
                        <animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="1" begin="-0.33s" repeatCount="indefinite"></animate>
                        <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1" begin="-0.33s" repeatCount="indefinite"></animate>
                    </circle>
                    <circle cx="61" cy="50" r="4" ng-attr-fill="{{config.c2}}" fill="#ab73d2">
                        <animate attributeName="cx" calcMode="linear" values="95;35" keyTimes="0;1" dur="1" begin="0s" repeatCount="indefinite"></animate>
                        <animate attributeName="fill-opacity" calcMode="linear" values="0;1;1" keyTimes="0;0.2;1" dur="1" begin="0s" repeatCount="indefinite"></animate>
                    </circle>
                </g>
                <g ng-attr-transform="translate({{config.showBeanOffset}} 0)" transform="translate(-15 0)">
                    <path d="M50 50L20 50A30 30 0 0 0 80 50Z" ng-attr-fill="{{config.c1}}" fill="#fe0066" transform="rotate(39 50 50)">
                        <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;45 50 50;0 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform>
                    </path>
                    <path d="M50 50L20 50A30 30 0 0 1 80 50Z" ng-attr-fill="{{config.c1}}" fill="#fe0066" transform="rotate(-39 50 50)">
                        <animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 50 50;-45 50 50;0 50 50" keyTimes="0;0.5;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform>
                    </path>
                </g>
            </svg>
        </div>

        <div id="preloading-game" class="game-splash-screen" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'start_game_frame()' ?>">
            <div class="row">
                <div class="text-center">
                    <img class="img-thumbnail" src="<?php echo \helper\image::get_thumbnail($game->image, 255, 200, "m"); ?>" width="255" height="200" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                    <button class="btn btn-lg btn-danger play-button" aria-label="play game">Play Game</button>
                    <div class="title"><?php echo $game_name; ?></div>
                </div>
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
                }
                if (document.querySelector('body').className == "overflow") {
                    document.querySelector('body').classList.remove('overflow');
                }
            }, 700); // 1000 == (1s)

            document.addEventListener('DOMContentLoaded', function() {
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    setTimeout(() => {
                        start_game_frame();
                    }, 700); // 1000 convert (s)
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
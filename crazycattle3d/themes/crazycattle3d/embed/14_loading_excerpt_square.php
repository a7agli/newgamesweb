<?php
// 14_loading_excerpt_square: background: color + img square + excerpt
// layout: name- img - btn - loading (o) - excerpt

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

            .rocket-splash-background-container {
                overflow: hidden;
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #0051a8;
                background: -moz-linear-gradient(14deg, #0051a8 0, #0076f8 100%);
                background: -webkit-linear-gradient(14deg, #0051a8, #0076f8);
                background: linear-gradient(14deg, #0051a8, #0076f8);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#0051a8", endColorstr="#0076f8", GradientType=1)
            }

            .rocket-splash-container {
                display: flex;
                flex-flow: column;
                box-sizing: border-box;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%
            }

            .rocket-splash-top {
                flex-flow: column;
                flex: 1
            }

            .rocket-splash-bottom,
            .rocket-splash-top {
                display: flex;
                box-sizing: border-box;
                align-self: center;
                justify-content: center
            }

            .rocket-splash-bottom {
                flex-flow: column;
                width: 100%;
                padding-left: 6px;
                padding-right: 6px;
                padding-bottom: 6px
            }

            .rocket-splash-top>div>button {
                margin: auto;
                padding: 8px;
                border-radius: 30px;
                border: 0;
                background-color: #59b21f;
                width: 210px;
                height: 48px;
                box-shadow: 0 5px 0 #3e8e0d;
                position: relative;
                overflow: hidden;
                cursor: pointer
            }

            .rocket-splash-top>div>button .text {
                color: #fff;
                text-transform: uppercase;
                font-size: 17px;
                text-align: center;
                position: absolute;
                z-index: 1;
                left: 0;
                top: 12px;
                width: 100%
            }

            .bubbles {
                position: absolute;
                width: 100%;
                height: 100%;
                left: 0;
                top: 0
            }

            .green-bubbles .bubble:after,
            .green-bubbles .bubble:before {
                position: absolute;
                background: #449c0c;
                content: " ";
                border-radius: 50%;
                display: block
            }

            .green-bubbles .left {
                width: 1px;
                height: 1px;
                position: absolute;
                display: block
            }

            .green-bubbles .left:before {
                width: 30px;
                height: 30px;
                left: 0;
                top: -17px
            }

            .green-bubbles .left:after {
                width: 50px;
                height: 50px;
                left: 10px;
                top: 34px
            }

            .green-bubbles .left:after,
            .green-bubbles .right:after {
                position: absolute;
                background: #449c0c;
                content: " ";
                border-radius: 50%
            }

            .green-bubbles .right:after {
                width: 56px;
                right: 0;
                top: 17px;
                height: 55px
            }

            .rocket-splash-top>div>button:hover {
                background: #3e8e0c;
                box-shadow: 0 5px 0 #347909
            }

            .rocket-splash-top>div>button:active {
                background: #337b06;
                box-shadow: 0 5px 0 #2b7100
            }

            .rocket-splash-top>div>button:hover .green-bubbles .left:after,
            .rocket-splash-top>div>button:hover .green-bubbles .left:before,
            .rocket-splash-top>div>button:hover .green-bubbles .right:after {
                background: #52b513
            }


            .rocket-splash-top>div>div.game-image {
                position: relative;
                width: 120px;
                height: 120px;
                margin: auto auto 20px;
                border-radius: 20px;
                overflow: hidden;
                background-image: var(--thumb);
                background-position: 50%;
                background-size: cover;
                transition: ease 0.5s;
                cursor: pointer;
            }

            .rocket-splash-top>div>div.game-image:hover {
                box-shadow: 0px 0px 10px 3px #59b21f;
                /* box-shadow: 0px -3px 10px 3px #59b21f; */
            }

            .rocket-splash-bottom>.rocket-splash-consent {
                box-sizing: border-box;
                width: 100%;
                color: #3991ef;
                text-align: justify;
                position: absolute;
                font-size: 12px;
                font-family: Arial;
                font-weight: 400;
                background: rgba(0, 56, 111, .78);
                line-height: 150%;
                padding: 10px 30px;
                left: 0;
                bottom: 0
            }

            .rocket-splash-top>.game>.rocket-splash-title {
                box-sizing: border-box;
                width: 100%;
                color: #fff;
                text-align: justify;
                font-weight: 400;
                line-height: 150%;
                font-size: 20px;
                text-align: center;
                padding-bottom: 20px;
                cursor: default;
                text-transform: uppercase
            }

            .rocket-splash-bottom>.rocket-splash-consent a {
                color: #60bdea !important
            }

            .rocket-splash-bottom>.rocket-splash-consent a:active,
            .rocket-splash-bottom>.rocket-splash-consent a:hover {
                color: #9cdfff !important
            }

            .rocket-loader,
            .rocket-loader:after {
                border-radius: 50%;
                width: 1.5em;
                height: 1.5em
            }

            .rocket-loader {
                box-sizing: content-box;
                margin: 0 auto;
                font-size: 10px;
                position: relative;
                text-indent: -9999em;
                border: 1.1em solid hsla(0, 0%, 100%, .2);
                border-left-color: #fff;
                -webkit-transform: translateZ(0);
                -ms-transform: translateZ(0);
                transform: translateZ(0);
                -webkit-animation: rocket-load8 1.1s linear infinite;
                animation: rocket-load8 1.1s linear infinite;
                display: none
            }

            @-webkit-keyframes rocket-load8 {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            @keyframes rocket-load8 {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
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
        <div id="preloading-game" class="rocket-splash-background-container">
            <div class="rocket-splash-container">
                <div class="rocket-splash-top">
                    <div class="game" style="margin-top: -50px;">
                        <div class="rocket-splash-title"><?php echo $game_name; ?></div>
                        <div class="game-image" style="--thumb: url(<?php echo $domain_url . \helper\image::get_thumbnail($game->image, 120, 120, 'm') ?>);"
                            onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.2)' ?>" title="<?php echo $game_name; ?>"></div>
                        <button id="btn_play" style="display: block; margin-bottom: -11px" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.2)' ?>" title="<?php echo $game_name; ?>" aria-label="play game">
                            <span class="text">PLAY NOW</span><span class="bubbles green-bubbles"><i class="left bubble"></i><i class="right bubble"></i></span></button>
                        <div id="loading_css_animation" class="rocket-loader" style="display: none;">Loading...</div>

                    </div>
                </div>
                <?php if ($game->excerpt) : ?>
                    <div class="rocket-splash-bottom">
                        <div class="rocket-splash-consent"><?php echo $game->excerpt ?></div>
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
                        loading_game(1.2);
                    }
                }
            })

            function loading_game(duration) {
                if (document.getElementById("btn_play")) {
                    document.getElementById("btn_play").style.display = 'none';
                }
                document.getElementById("loading_css_animation").style.display = 'block';

                setTimeout(() => {
                    start_game_frame();
                }, duration * 800); // 1000 convert (s)
            }

            // open url: external
            function openInNewWindow() {
                let height2 = window.innerHeight || 600;
                let width2 = window.innerWidth || 600;
                window.open(url_game, "", "width=" + width2 + ",height=" + height2);
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
        </script>
    </body>

    </html>
<?php endif; ?>
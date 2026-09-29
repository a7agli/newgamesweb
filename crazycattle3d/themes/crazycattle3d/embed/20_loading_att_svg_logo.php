<?php
// 20_loading_att_svg_logo: background: img blur
// layout: background blur: img - img logo - loading attribute svg wrap: img - name - flip effect btn

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


            .gpxLoader-container {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #000;
            }

            .gpxLoader-blur-image {
                width: 100%;
                height: 100%;
                -webkit-filter: blur(20px);
                filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                background-position: 50% !important;
                background-repeat: no-repeat !important;
                background-size: cover !important;
                position: absolute;
                top: 0;
                left: 0;
                transform: scale(1.3);
                z-index: -1;
                opacity: .7
            }

            .gpxLoader-game-container {
                position: absolute;
                top: 47%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100%
            }

            .gpxLoader-game-icon {
                position: relative;
                display: block;
                margin: 30px auto;
                width: 135px;
                height: 135px;
                border-radius: 70px;
                background-size: cover;
                box-shadow: 0 2px 15px 0 rgba(6, 29, 98, .7), inset 0 5px 2px 0 hsla(0, 0%, 96%, .5)
            }

            .gpxLoader-game-icon svg {
                position: absolute;
                left: -20px;
                top: -20px;
                box-shadow: 0 0 15px rgba(6, 29, 98, .7);
                border-radius: 50%;
                background-color: rgba(6, 29, 98, .35);
                z-index: -1
            }

            .gpxLoader-game-icon svg circle {
                fill: transparent;
                stroke-width: 7px;
                stroke-dashoffset: 71;
                stroke-linecap: round;
                transform-origin: 50% 50%
            }

            .gpxLoader-game-icon svg circle.circle-container {
                stroke: hsla(0, 0%, 100%, .4)
            }

            .gpxLoader-logo {
                margin: 0 auto 30px;
                display: block;
                width: 250px;
                height: 75px;
                max-width: 100%;
                background-size: contain;
                background-repeat: no-repeat;
                background-position: 50%;
            }

            .gpxLoader-logo.gamepix-logo {
                max-width: 265px;
                height: 75px
            }

            .gpxLoader-game-title,
            .gpxLoader-label-progress {
                color: #fff;
                display: block;
                margin: 35px auto 40px;
                text-align: center;
                text-transform: capitalize;
                font-size: 24px;
                font-weight: 700;
                text-shadow: -1px 0 7px rgba(6, 29, 98, .3), 0 1px 7px rgba(6, 29, 98, .3), 1px 0 7px rgba(6, 29, 98, .3), 0 -1px 7px rgba(6, 29, 98, .3)
            }

            .gpxLoader-label-progress {
                font-size: 26px;
                margin: 0;
                height: 50px
            }

            .gpxLoader-label-progress span {
                font-size: 36px
            }

            .gpxLoader-button {
                display: block;
                margin: 0;
                width: 200px;
                height: 50px;
                border-radius: 10px;
                box-shadow: inset 0 2px 4px 0 hsla(0, 0%, 100%, .38), inset 0 -3px 3px 0 rgba(0, 0, 0, .2), 0 8px 15px 0 rgba(6, 29, 98, .5);
                /* background-color: #51e325; */
                background-color: #329bff;
                font-size: 18px;
                font-weight: 700;
                /* color: #0b2167; */
                color: #000;
                text-transform: uppercase;
                border: none;
                cursor: pointer;
                padding: 0
            }

            .flip-card {
                background-color: transparent;
                perspective: 1000px;
                margin: 35px auto 0;
                width: 200px;
                height: 50px
            }

            .flip-card-inner {
                position: relative;
                width: 100%;
                height: 100%;
                text-align: center;
                transition: transform .8s;
                transform-style: preserve-3d
            }

            .flip-card.active .flip-card-inner {
                transform: rotateY(180deg)
            }

            .flip-card-back,
            .flip-card-front {
                position: absolute;
                width: 100%;
                height: 100%;
            }

            .flip-card.active .flip-card-front {
                transition-delay: .25s;
                transition-duration: .1s;
            }

            .flip-card-back {
                transform: rotateY(180deg)
            }

            @media screen and (orientation: landscape) {
                .gpxLoader-logo {
                    width: 180px
                }

                .gpxLoader-game-title {
                    margin-bottom: 15px
                }

                .flip-card {
                    margin-top: 15px
                }
            }

            @media screen and (orientation: landscape) and (max-height:520px) {
                .zoomable {
                    zoom: .9
                }
            }

            @media screen and (orientation: landscape) and (max-height:470px) {
                .zoomable {
                    zoom: .8
                }
            }

            @media screen and (orientation: landscape) and (max-height:425px) {
                .zoomable {
                    zoom: .7
                }
            }

            @media screen and (orientation: landscape) and (max-height:370px) {
                .zoomable {
                    zoom: .6
                }
            }

            @media screen and (orientation: landscape) and (max-height:335px) {
                .zoomable {
                    zoom: .5
                }
            }

            @media screen and (orientation: landscape) and (max-height:275px) {
                .zoomable {
                    zoom: .4
                }
            }

            @media screen and (orientation: portrait) and (max-height:645px) {
                .zoomable {
                    zoom: .8
                }
            }

            @media screen and (orientation: portrait) and (max-height:520px) {
                .zoomable {
                    zoom: .7
                }
            }

            @media screen and (orientation: portrait) and (max-height:430px) {
                .zoomable {
                    zoom: .6
                }
            }

            @media screen and (orientation: portrait) and (max-height:370px) {
                .zoomable {
                    zoom: .5
                }
            }

            @media screen and (orientation: portrait) and (max-height:320px) {
                .zoomable {
                    zoom: .4
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

        <div id="preloading-game" class="gpxLoader-container">
            <div class="gpxLoader-blur-image zoomable" style="background-image: url(&quot;<?php echo \helper\image::get_thumbnail($game->image, 400, 250, "m"); ?>&quot;), url(&quot;<?php echo \helper\image::get_thumbnail($game->image, 105, 105, "m"); ?>&quot;);"></div>
            <div class="gpxLoader-game-container zoomable">
                <div class="gpxLoader-logo gamepix-logo zoomable"
                    style="background-image: url(&quot;<?php echo \helper\image::get_thumbnail(\helper\options::options_by_key_type('logo'), 265, '', "w"); ?>&quot;);"></div>
                <div class="gpxLoader-game-icon" style="background-image: url(&quot;<?php echo \helper\image::get_thumbnail($game->image, 105, 105, "m"); ?>&quot;);">
                    <svg width="175" height="175" viewBox="0 0 100 100">
                        <linearGradient id="linearColors" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#00d666"></stop>
                            <stop offset="50%" stop-color="#00a8e7"></stop>
                            <stop offset="100%" stop-color="#006ce7"></stop>
                        </linearGradient>
                        <circle cx="50" cy="50" r="45" stroke-dasharray="283 0" class="circle-container"></circle>
                        <circle id="loading_svg_circle" cx="50" cy="50" r="45" stroke-dashoffset="68" stroke-dasharray="0 283" stroke="url(#linearColors)"></circle>
                    </svg>
                </div>
                <div class="gpxLoader-game-title"><?php echo $game_name; ?></div>
                <div id="flipCard" class="flip-card active">
                    <div class="flip-card-inner" id="action">
                        <div class="flip-card-front" id="btn_play" style="display: none;">
                            <button class="gpxLoader-button" onclick="<?php echo ($game_type == 'EXTERNAL') ? 'openInNewWindow()' : 'start_game_frame()' ?>" aria-label="play game">Ok, Play Now!</button>
                        </div>
                        <div class="flip-card-back" id="loading_percentage_wrap">
                            <div class="gpxLoader-label-progress">Loading <span id="loading_percentage">0%</span></div>
                        </div>
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
                loading_game()

                if (game_type != 'EXTERNAL' && check_load_now) {
                    start_game_frame();
                } else {
                    if (game_type == 'IFRAME_HTML') {
                        setTimeout(() => {
                            start_game_frame();
                        }, 1240); // 1000 convert (s)
                    }
                }
            })

            function loading_game() {
                const loading_svg_circle = document.getElementById('loading_svg_circle');
                const loading_percentage = document.getElementById('loading_percentage');
                let percentage = 283;
                let percentage2 = 0;
                let percentage3 = 0;

                function animate_svg_circle() {
                    percentage -= 4.4;
                    percentage2 += 4.4;
                    loading_svg_circle.setAttribute('stroke-dasharray', `${percentage2} ${percentage}`);
                    if (percentage2 < 283) {
                        requestAnimationFrame(animate_svg_circle);
                    }
                }

                function animate_percentage() {
                    percentage3 += 1.5;
                    loading_percentage.innerText = `${Math.floor(percentage3)}%`;
                    if (percentage3 < 100) {
                        requestAnimationFrame(animate_percentage);
                    } else {
                        if (document.getElementById("loading_percentage_wrap")) {
                            document.getElementById("loading_percentage_wrap").remove();
                        }
                        if (document.getElementById("btn_play")) {
                            document.getElementById("btn_play").style.display = "block";
                        }
                        if (document.getElementById("action")) {
                            document.getElementById("action").style.transform = "unset";
                        }
                    }
                }
                requestAnimationFrame(animate_svg_circle);
                requestAnimationFrame(animate_percentage);
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
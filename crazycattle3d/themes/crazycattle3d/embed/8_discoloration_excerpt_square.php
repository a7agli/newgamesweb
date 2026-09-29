<?php
// 8_discoloration_excerpt_square: background: color + loading + $game->excerpt + img square
// layout: img - btn - loading - name - excerpt

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
            }

            html,
            body {
                color: #eee;
                background: #000;
                background-color: #000;
            }

            .pluto-splash-container {
                display: flex;
                flex-direction: column;
                font-family: Helvetica, Arial, sans-serif;
                background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab) 0 0/300% 300%;
                animation: 60s infinite pluto-gradient
            }

            .pluto-splash-abstract,
            .pluto-splash-container {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0
            }

            .pluto-splash-top {
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                width: 100%
            }

            .pluto-splash-center {
                display: flex;
                flex-grow: 1;
                position: relative;
                flex-basis: 100%;
                overflow: hidden
            }

            .pluto-splash-game-metadata,
            .pluto-splash-left {
                justify-content: center;
                display: flex;
                position: relative
            }

            .pluto-splash-left {
                align-items: center
            }

            .pluto-splash-game {
                display: flex;
                flex-grow: 1;
                flex-direction: column;
                flex-basis: 100%
            }

            .pluto-splash-game-metadata {
                flex-direction: column;
                flex-grow: 1
            }

            .pluto-splash-game-consent {
                display: flex;
                justify-content: center;
                margin: 0pluto-5em
            }

            .pluto-splash-game-consent>p {
                text-align: justify;
                font-size: 12px;
                font-family: Arial;
                font-weight: 400;
                max-width: 300px
            }

            .pluto-splash-game-consent>p>a {
                color: #fff
            }

            .pluto-splash-game-thumbnail-play {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center
            }

            .pluto-splash-game-title {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 4px;
                font-size: 1pluto-5em;
                color: #fff
            }

            .pluto-splash-game-thumbnail {
                display: flex;
                justify-content: center;
                align-items: flex-end;
                position: relative;
                margin: 4px
            }

            .pluto-splash-game-play {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                margin: 6px
            }

            .pluto-splash-game-description {
                display: flex;
                justify-content: center;
                align-items: flex-end;
                margin: 4px;
                text-align: justify;
                font-size: 14px;
                font-family: Arial;
                font-weight: 400
            }

            .pluto-splash-game-title>p {
                max-width: 300px;
                padding: 8px 24px;
                text-transform: uppercase;
                text-align: center;
                box-sizing: border-box
            }

            .pluto-splash-game-description>p {
                overflow: auto;
                max-width: 300px;
                max-height: 200px;
                margin: 15px 0
            }

            .pluto-splash-game-thumbnail>img {
                border-radius: 4px;
                box-shadow: 0 1px 2px transparent;
                border: 2px solid hsla(0, 0%, 100%, .9)
            }

            .pluto-splash-game-play>button {
                padding: 8px;
                border-radius: 6px;
                border: 0;
                text-transform: uppercase;
                font-weight: 700;
                font-size: 24px;
                cursor: pointer;
                box-shadow: 0 1px 2px transparent;
                width: 150px;
                background-color: hsla(0, 0%, 100%, .9)
            }

            .pluto-loader,
            .pluto-loader:after {
                border-radius: 50%;
                width: 1.5em;
                height: 1.5em
            }

            .pluto-loader {
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
                -webkit-animation: 1.1s linear infinite load8;
                animation: 1.1s linear infinite load8;
                display: none
            }

            @-webkit-keyframes load8 {
                0% {
                    -webkit-transform: rotate(0);
                    transform: rotate(0)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            @keyframes load8 {
                0% {
                    -webkit-transform: rotate(0);
                    transform: rotate(0)
                }

                to {
                    -webkit-transform: rotate(1turn);
                    transform: rotate(1turn)
                }
            }

            @media screen and (max-height:600px) {
                .pluto-splash-game-description {
                    display: none
                }
            }

            @media screen and (min-width:600px) {
                .pluto-splash-center>.pluto-splash-left {
                    display: flex
                }

                .pluto-splash-game-consent>p,
                .pluto-splash-game-description>p,
                .pluto-splash-game-title>p {
                    max-width: 500px
                }
            }

            @media screen and (min-height:600px) {
                .pluto-splash-container>.pluto-splash-top {
                    display: flex
                }
            }

            @keyframes pluto-gradient {

                0%,
                to {
                    background-position: 0 50%
                }

                50% {
                    background-position: 100% 50%
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

        <div id="splash" style="z-index: 1010;position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;">
            <div class="pluto-splash-container">
                <div class="pluto-splash-center">
                    <div id="pluto-splash-slot-left" class="pluto-splash-left" style="display: none;"></div>
                    <div id="pluto-splash-game" class="pluto-splash-game">
                        <div class="pluto-splash-game-metadata">
                            <div class="pluto-splash-game-thumbnail-play">
                                <div class="pluto-splash-game-thumbnail">
                                    <img src="<?php echo \helper\image::get_thumbnail($game->image, 150, 150, 'm'); ?>" width="150" height="150" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                                </div>
                                <div class="pluto-splash-game-play">
                                    <button id="pluto-splash-button" style="display: block;" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1)' ?>"
                                        title="<?php echo $game_name; ?>" aria-label="play game">PLAY</button>
                                    <div id="loading_embed" class="pluto-loader" style="display: none;">Loading...</div>
                                </div>
                            </div>
                            <div class="pluto-splash-game-title">
                                <p><?php echo ucwords($game_name) ?></p>
                            </div>
                            <?php if ($game->excerpt) : ?>
                                <div class="pluto-splash-game-description">
                                    <p><?php echo $game->excerpt; ?></p>
                                </div>
                            <?php endif ?>
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
                if (game_type != 'EXTERNAL' && check_load_now) {
                    start_game_frame();
                } else {
                    if (game_type == 'IFRAME_HTML') {
                        loading_game(1);
                    }
                }
            })

            function loading_game(duration) {
                document.getElementById('pluto-splash-button').style.display = 'none';
                document.getElementById('loading_embed').style.display = 'block';

                setTimeout(() => {
                    start_game_frame();
                }, duration * 900); // 1000 convert (s)
            }

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
                if (document.getElementById("splash")) {
                    document.getElementById("splash").remove();
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
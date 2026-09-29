<?php
// 19_loading_logo: background: img blur 
// layout: background blur: img - name - img - btn

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

            div.game-iframe.svelte-7qmbuh.svelte-7qmbuh {
                aspect-ratio: 16 / 9;
                overflow: hidden;
                position: relative;
                width: 100%;
                height: 100%;
                z-index: 0;
            }

            div.game-iframe.svelte-7qmbuh div.background.svelte-7qmbuh {
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                bottom: 0;
                display: flex;
                filter: blur(8px);
                left: 0;
                opacity: .8;
                position: absolute;
                right: 0;
                top: 0;
                transform: scale(1.4);
                transition: background 1s;
                z-index: -1;
            }

            div.game-iframe.svelte-7qmbuh div.main-content.svelte-7qmbuh {
                display: flex;
                flex-direction: row;
                height: 100%;
                position: relative;
            }

            div.game-iframe-item.svelte-li3b1p.svelte-li3b1p {
                align-items: center;
                display: flex;
                gap: 8px;
                flex-direction: column;
                justify-content: center;
                width: 100%;
            }

            div.game-iframe-item.svelte-li3b1p span.title.svelte-li3b1p {
                color: #fff;
                font-size: 18px;
                font-weight: 700;
                text-transform: uppercase;
            }

            div.game-iframe-item.svelte-li3b1p img.svelte-li3b1p {
                border-radius: 12px;
                box-shadow: 0 4px 6px #1312308f;
                margin-top: 8px;
            }

            div.game-iframe-item.svelte-li3b1p button.play-now-button.svelte-li3b1p {
                background: #34d834;
                border: none;
                border-radius: 10px;
                box-shadow: inset 0 2px 4px #ffffff60, inset 0 -3px 3px #00000031, 0 8px 15px #061d6280;
                color: #0b2167;
                font-size: 18px;
                font-weight: 600;
                height: 47px;
                margin-top: 27px;
                padding: 0 30px;
                text-transform: uppercase;
                width: 174px;
            }

            div.game-iframe-item.svelte-li3b1p button.play-now-button.svelte-li3b1p:hover {
                background-color: #76ee52;
                color: #0b2167;
                cursor: pointer;
            }

            /* loading logo */
            div.game-iframe.svelte-7qmbuh div.main-content div.game.svelte-7qmbuh {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                pointer-events: auto;
                background-color: #063483;
                background-color: #2d5fb5;
                background-size: 100px 50px;
                background-position: center;
                background-repeat: no-repeat;
            }

            div.game-iframe.svelte-7qmbuh div.main-content div.game.play-logo.svelte-7qmbuh {
                align-items: center;
                display: flex;
                justify-content: center;
                z-index: 3;
            }

            div.logo.svelte-t9xkxv.svelte-t9xkxv {
                height: auto;
                width: 201px;
            }

            div.logo.svelte-t9xkxv img.svelte-t9xkxv {
                height: auto;
                width: 100%;
            }

            @keyframes __svelte_806785510_0 {
                0% {
                    transform: scale(-1.77636e-15);
                }

                1.38883% {
                    transform: scale(0.0129162);
                }

                2.77767% {
                    transform: scale(0.0216661);
                }

                4.1665% {
                    transform: scale(0.0262497);
                }

                5.55533% {
                    transform: scale(0.0266669);
                }

                6.94417% {
                    transform: scale(0.0229178);
                }

                8.333% {
                    transform: scale(0.0150024);
                }

                9.72183% {
                    transform: scale(0.00292063);
                }

                11.1107% {
                    transform: scale(0.0216601);
                }

                12.4995% {
                    transform: scale(0.0445563);
                }

                13.8883% {
                    transform: scale(0.0627976);
                }

                15.2772% {
                    transform: scale(0.0763839);
                }

                16.666% {
                    transform: scale(0.0853154);
                }

                18.0548% {
                    transform: scale(0.0895919);
                }

                19.4437% {
                    transform: scale(0.0892136);
                }

                20.8325% {
                    transform: scale(0.0841803);
                }

                22.2213% {
                    transform: scale(0.0744921);
                }

                23.6102% {
                    transform: scale(0.0601491);
                }

                24.999% {
                    transform: scale(0.0411511);
                }

                26.3878% {
                    transform: scale(0.0174982);
                }

                27.7767% {
                    transform: scale(0.0163995);
                }

                29.1655% {
                    transform: scale(0.0592103);
                }

                30.5543% {
                    transform: scale(0.0985202);
                }

                31.9432% {
                    transform: scale(0.134329);
                }

                33.332% {
                    transform: scale(0.166637);
                }

                34.7208% {
                    transform: scale(0.195445);
                }

                36.1097% {
                    transform: scale(0.220751);
                }

                37.4985% {
                    transform: scale(0.242556);
                }

                38.8873% {
                    transform: scale(0.260861);
                }

                40.2762% {
                    transform: scale(0.275665);
                }

                41.665% {
                    transform: scale(0.286968);
                }

                43.0538% {
                    transform: scale(0.29477);
                }

                44.4427% {
                    transform: scale(0.299071);
                }

                45.8315% {
                    transform: scale(0.299871);
                }

                47.2203% {
                    transform: scale(0.29717);
                }

                48.6092% {
                    transform: scale(0.290969);
                }

                49.998% {
                    transform: scale(0.281266);
                }

                51.3868% {
                    transform: scale(0.268063);
                }

                52.7757% {
                    transform: scale(0.251359);
                }

                54.1645% {
                    transform: scale(0.231154);
                }

                55.5533% {
                    transform: scale(0.207448);
                }

                56.9422% {
                    transform: scale(0.180241);
                }

                58.331% {
                    transform: scale(0.149534);
                }

                59.7198% {
                    transform: scale(0.115325);
                }

                61.1087% {
                    transform: scale(0.0776158);
                }

                62.4975% {
                    transform: scale(0.0364055);
                }

                63.8863% {
                    transform: scale(0.0137011);
                }

                65.2752% {
                    transform: scale(0.0881031);
                }

                66.664% {
                    transform: scale(0.159588);
                }

                68.0528% {
                    transform: scale(0.228155);
                }

                69.4417% {
                    transform: scale(0.293805);
                }

                70.8305% {
                    transform: scale(0.356537);
                }

                72.2193% {
                    transform: scale(0.416352);
                }

                73.6082% {
                    transform: scale(0.47325);
                }

                74.997% {
                    transform: scale(0.52723);
                }

                76.3858% {
                    transform: scale(0.578293);
                }

                77.7747% {
                    transform: scale(0.626439);
                }

                79.1635% {
                    transform: scale(0.671667);
                }

                80.5523% {
                    transform: scale(0.713977);
                }

                81.9412% {
                    transform: scale(0.753371);
                }

                83.33% {
                    transform: scale(0.789847);
                }

                84.7188% {
                    transform: scale(0.823405);
                }

                86.1077% {
                    transform: scale(0.854046);
                }

                87.4965% {
                    transform: scale(0.88177);
                }

                88.8853% {
                    transform: scale(0.906576);
                }

                90.2742% {
                    transform: scale(0.928465);
                }

                91.663% {
                    transform: scale(0.947436);
                }

                93.0518% {
                    transform: scale(0.963491);
                }

                94.4407% {
                    transform: scale(0.976627);
                }

                95.8295% {
                    transform: scale(0.986846);
                }

                97.2183% {
                    transform: scale(0.994148);
                }

                98.6072% {
                    transform: scale(0.998533);
                }

                99.996% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(1);
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
        <div id="preloading-game" class="game-iframe desktop svelte-7qmbuh">
            <div class="background svelte-7qmbuh" style="background-image: url(<?php echo \helper\image::get_thumbnail($game->image, 280, 157, "m"); ?>)"></div>
            <div class="main-content svelte-7qmbuh">
                <div class="game-iframe-item svelte-li3b1p"> <span class="title svelte-li3b1p"><?php echo $game_name; ?></span>
                    <picture>
                        <img class="svelte-li3b1p" src="<?php echo \helper\image::get_thumbnail($game->image, 280, 157, "m"); ?>" width="280" height="157" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img">
                    </picture>
                    <button class="play-now-button ripple svelte-li3b1p" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(1.4)' ?>" aria-label="play game">PLAY NOW</button>
                </div>
                <div id="loading_logo" class="game play-logo svelte-7qmbuh" style="display: none;">
                    <div class="logo svelte-t9xkxv" style="animation: 1200ms linear 0ms 1 normal both running __svelte_806785510_0;">
                        <img src="<?php echo \helper\image::get_thumbnail(\helper\options::options_by_key_type('logo'), 201, '', "w"); ?>" class="svelte-t9xkxv" title="logo" alt="logo img">
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
                        loading_game(1.4);
                    }
                }
            })

            function loading_game(duration) {
                if (document.getElementById("loading_logo")) {
                    document.getElementById("loading_logo").style.display = 'flex';
                }
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
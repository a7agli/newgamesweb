<?php
// 4_loading_img:  background: img + img wrap blur
// layout: background: img + img wrap blur + btn + crossbar loading

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

            .flex-center {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .absolute_inset_0 {
                position: absolute;
                inset: 0px
            }

            .absolute_bottom_0 {
                position: absolute;
                bottom: 0px
            }

            .iframe_embed {
                width: 100%;
                height: 100%;
                margin: auto;
                aspect-ratio: 16/9
            }

            .bg-all {
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
                -o-object-fit: cover;
                object-fit: cover;
                background-size: cover;
                z-index: 0
            }

            .blur_max {
                /* --tw-grayscale: grayscale(100%); */
                --tw-grayscale: grayscale(50%);
                filter: var(--tw-grayscale);
                -webkit-filter: blur(1.3em);
                filter: blur(1.3em);
                opacity: 0.9;
            }

            .blur_min {
                transition-property: -webkit-clip-path;
                transition-property: clip-path;
                transition-property: clip-path, -webkit-clip-path;
                transition-timing-function: cubic-bezier(.4, 0, .2, 1);
                transition-duration: .15s;

                -webkit-filter: blur(0.4em);
                filter: blur(0.4em);
                opacity: 1;
            }

            .loading_percentage {
                display: flex;
                align-items: center;
                right: 0px;
                height: 24px;
                width: 100%;
                /* background-color: hsl(258deg 24% 8% / 1); */
                background-color: hsl(258deg 24% 8% / .4);
            }

            .loading_percentage_text {
                font-size: .75rem;
                line-height: 1rem;
                font-weight: 400;
                letter-spacing: .3px;
                --tw-text-opacity: 1;
                color: hsl(258deg 24% 100% / var(--tw-text-opacity));
            }

            .loading_percentage_crossbar {
                border-radius: 0 0 4px 4px;
                transition-property: width;
                transition-timing-function: cubic-bezier(.4, 0, .2, 1);
                transition-duration: .15s;
                --tw-bg-opacity: 1;
                background-color: hsl(347deg 96% 55% / var(--tw-bg-opacity));

                height: 4px;
                left: 0px;
            }

            /* btn */
            .gxbtn-main {
                flex-direction: row;
                gap: .5rem;
                padding: 1rem 2rem;
                color: hsl(0 0 100%);
                background-color: hsl(347deg 96% 55% / 1);
                border: 1px solid hsl(47deg 96% 77% / 1);
                border-radius: .25rem;
                box-shadow: var(0 0 #0000, 0 0 #0000), var(0 0 #0000, 0 0 #0000), 0 4px hsl(258deg 24% 12% / 1);
                transition-property: all;
                transition-timing-function: cubic-bezier(.4, 0, .2, 1);
                transition-duration: .15s;
                will-change: transform;
                font-size: 20px;
                font-weight: 700;
                letter-spacing: -.5px;
                line-height: 28px;
                cursor: pointer;
            }

            @media (max-width:500px) {
                .gxbtn-main {
                    font-size: 14px;
                    font-weight: 600;
                    letter-spacing: .3px;
                    line-height: 20px;
                    padding: .75rem 1rem;
                }
            }

            @media (min-width:500px) {
                .gxbtn-main {
                    min-width: 11rem
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

        <div id="preloading-game" class="absolute_inset_0 flex-center iframe_embed">
            <div class="absolute_inset_0 bg-all blur_max" style="background-image: url(&quot;<?php echo \helper\image::get_thumbnail($game->image, 238, 140, "m"); ?>&quot;);"></div>
            <div class="absolute_inset_0 bg-all blur_min" id="loading_img"
                style="clip-path: inset(0px 100% 0px 0px); background-image: url(&quot;<?php echo \helper\image::get_thumbnail($game->image, 238, 140, "m"); ?>&quot;);">
            </div>
            <?php if ($game->type != 'IFRAME_HTML') : ?>
                <button id="btn_play" class="flex-center gxbtn-main" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game2(1.5)' ?>"
                    title="<?php echo $game_name; ?>" aria-label="play game">Play now
                </button>
            <?php endif; ?>
            <div id="loading_percentage" class="absolute_bottom_0 loading_percentage" style="display: none;">
                <span class="loading_percentage_text">Downloading data</span>
                <div class="absolute_bottom_0  loading_percentage_crossbar" id="loading_img2" style="width: 0%;"></div>
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
                        loading_game2(1.5);
                    }
                }
            })

            function loading_game(duration) {
                const loading_img = document.getElementById('loading_img');
                const loading_img2 = document.getElementById('loading_img2');
                let percentage = 100;
                let percentage2 = 0;
                if (document.getElementById("loading_percentage")) {
                    document.getElementById("loading_percentage").style.display = "block";
                }

                function animate() {
                    percentage -= 2;
                    percentage2 += 2;
                    loading_img.style.setProperty('clip-path', `inset(0px ${percentage}% 0px 0px)`);
                    loading_img2.style.width = `${percentage2}%`;
                    if (percentage > 0) {
                        requestAnimationFrame(animate);
                    }
                }
                requestAnimationFrame(animate);
            }


            function loading_game2(duration) {
                if (document.getElementById("btn_play")) {
                    document.getElementById("btn_play").style.display = "none";
                }
                loading_game(duration);

                setTimeout(() => {
                    start_game_frame();
                }, duration * 900); // 1000 convert (s)
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
<?php
// 18_loader_favicon_bgchange: background: img blur + btn vs background change
// layout: loader img favicon + background change blur: img - img - name - btn change

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

            .loader_action {
                display: flex;
                width: 100%;
                height: 100%;
                align-items: center;
                justify-content: center;
                --tw-bg-opacity: 1;
                background-color: rgb(3 7 18 / var(--tw-bg-opacity));
            }

            .animate-spin {
                width: 3.5rem;
                height: 3.5rem;
                animation: spin 1s linear infinite;
            }

            .loader_action_img {
                display: block;
                vertical-align: middle;
                max-width: 100%;
                height: auto;
                scrollbar-color: color-mix(in oklch, currentColor 35%, transparent) transparent;
            }

            @keyframes spin {
                to {
                    transform: rotate(1turn)
                }
            }
        </style>

        <style>
            body,
            h2 {
                margin: 0
            }

            .transition-all,
            .transition-transform {
                transition-duration: .15s
            }

            .ease-in-out,
            .transition-all,
            .transition-transform {
                transition-timing-function: cubic-bezier(.4, 0, .2, 1)
            }

            .hover\:scale-105:hover,
            .transform {
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }

            .from-blue-600\/50,
            .from-green-400,
            .hover\:from-blue-500:hover {
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
            }

            *,
            :after,
            :before {
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-gradient-from-position: ;
                --tw-gradient-via-position: ;
                --tw-gradient-to-position: ;
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                --tw-blur: ;
                --tw-brightness: ;
                --tw-contrast: ;
                --tw-grayscale: ;
                --tw-hue-rotate: ;
                --tw-invert: ;
                --tw-saturate: ;
                --tw-sepia: ;
                --tw-drop-shadow: ;
                box-sizing: border-box;
                border: 0 solid #e5e7eb
            }

            :after,
            :before {
                --tw-content: ""
            }

            :host,
            html {
                line-height: 1.5;
                -webkit-text-size-adjust: 100%;
                -moz-tab-size: 4;
                -o-tab-size: 4;
                tab-size: 4;
                font-family: ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
                font-feature-settings: normal;
                font-variation-settings: normal;
                -webkit-tap-highlight-color: transparent
            }

            body {
                line-height: inherit
            }

            abbr:where([title]) {
                -webkit-text-decoration: underline dotted;
                text-decoration: underline dotted
            }

            h2 {
                font-size: inherit;
                font-weight: inherit
            }

            button {
                text-transform: none;
                cursor: pointer
            }

            :-moz-focusring {
                outline: auto
            }

            :-moz-ui-invalid {
                box-shadow: none
            }

            .hover\:shadow-xl:hover,
            .shadow-lg {
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            ::-webkit-inner-spin-button,
            ::-webkit-outer-spin-button {
                height: auto
            }

            ::-webkit-search-decoration {
                -webkit-appearance: none
            }

            ::-webkit-file-upload-button {
                -webkit-appearance: button;
                font: inherit
            }

            :disabled {
                cursor: default
            }

            img {
                display: block;
                vertical-align: middle;
                max-width: 100%;
                height: auto
            }

            .pointer-events-none {
                pointer-events: none
            }

            .absolute {
                position: absolute
            }

            .relative {
                position: relative
            }

            .bottom-0 {
                bottom: 0
            }

            .bottom-1\/4 {
                bottom: 28%
            }

            .left-0 {
                left: 0
            }

            .left-1\/3 {
                left: 39.333333%
            }

            .left-1\/4 {
                left: 33%
            }

            .right-0 {
                right: 0
            }

            .right-1\/4 {
                right: 32%
            }

            .top-0 {
                top: 0
            }

            .top-1\/4 {
                top: 27%
            }

            .top-3\/4 {
                top: 74%
            }

            .flex {
                display: flex
            }

            .h-10 {
                height: 2.5rem
            }

            .h-6 {
                height: 1.5rem
            }

            .h-8 {
                height: 2rem
            }

            .h-full {
                height: 100%
            }

            .w-10 {
                width: 2.5rem
            }

            .w-36 {
                width: 9rem
            }

            .w-6 {
                width: 1.5rem
            }

            .w-8 {
                width: 2rem
            }

            .w-full {
                width: 100%
            }

            .min-w-\[200px\] {
                min-width: 200px
            }

            @keyframes pulse {
                50% {
                    opacity: .5
                }
            }

            .animate-pulse {
                animation: 2s cubic-bezier(.4, 0, .6, 1) infinite pulse
            }

            .flex-col {
                flex-direction: column
            }

            .items-center {
                align-items: center
            }

            .justify-center {
                justify-content: center
            }

            .gap-4 {
                gap: 1rem
            }

            .overflow-hidden {
                overflow: hidden
            }

            .rounded-full {
                border-radius: 9999px
            }

            .rounded-lg {
                border-radius: .5rem
            }

            .bg-blue-300 {
                --tw-bg-opacity: 1;
                background-color: rgb(147 197 253/var(--tw-bg-opacity))
            }

            .bg-purple-300 {
                --tw-bg-opacity: 1;
                background-color: rgb(216 180 254/var(--tw-bg-opacity))
            }

            .bg-yellow-300 {
                --tw-bg-opacity: 1;
                background-color: rgb(253 224 71/var(--tw-bg-opacity))
            }

            .bg-gradient-to-br {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops))
            }

            .bg-gradient-to-r {
                background-image: linear-gradient(to right, var(--tw-gradient-stops))
            }

            .from-blue-600\/50 {
                --tw-gradient-from: rgba(37, 99, 235, .5) var(--tw-gradient-from-position);
                --tw-gradient-to: rgba(37, 99, 235, 0) var(--tw-gradient-to-position)
            }

            .from-green-400 {
                --tw-gradient-from: #4ade80 var(--tw-gradient-from-position);
                --tw-gradient-to: rgba(74, 222, 128, 0) var(--tw-gradient-to-position)
            }

            .via-purple-600\/50 {
                --tw-gradient-to: rgba(147, 51, 234, 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), rgba(147, 51, 234, .5) var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .to-black\/70 {
                --tw-gradient-to: rgba(14, 23, 43, .7) var(--tw-gradient-to-position)
            }

            .to-blue-500 {
                --tw-gradient-to: #3b82f6 var(--tw-gradient-to-position)
            }

            .object-cover {
                -o-object-fit: cover;
                object-fit: cover
            }

            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .py-3 {
                padding-top: .75rem;
                padding-bottom: .75rem
            }

            .text-lg {
                font-size: 1.125rem;
                line-height: 1.75rem
            }

            .font-bold {
                font-weight: 700
            }

            .font-semibold {
                font-weight: 600
            }

            .text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255/var(--tw-text-opacity));
                text-transform: capitalize
            }

            .opacity-50 {
                opacity: .5
            }

            .shadow-lg {
                --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -4px rgba(0, 0, 0, .1);
                --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color)
            }

            .blur-\[15px\] {
                filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
                --tw-blur: blur(15px)
            }

            .transition-all {
                transition-property: all
            }

            .transition-transform {
                transition-property: transform
            }

            .duration-300 {
                transition-duration: .3s
            }

            .hover\:scale-105:hover {
                --tw-scale-x: 1.05;
                --tw-scale-y: 1.05
            }

            .hover\:animate-none:hover {
                animation: none
            }

            .hover\:from-blue-500:hover {
                --tw-gradient-from: #3b82f6 var(--tw-gradient-from-position);
                --tw-gradient-to: rgba(59, 130, 246, 0) var(--tw-gradient-to-position)
            }

            .hover\:to-green-400:hover {
                --tw-gradient-to: #4ade80 var(--tw-gradient-to-position)
            }

            .hover\:shadow-xl:hover {
                --tw-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 8px 10px -6px rgba(0, 0, 0, .1);
                --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color)
            }

            @media (min-width:768px) {
                .md\:w-64 {
                    width: 16rem
                }

                .md\:gap-6 {
                    gap: 1.5rem
                }

                .md\:px-10 {
                    padding-left: 2.5rem;
                    padding-right: 2.5rem
                }

                .md\:py-4 {
                    padding-top: 1rem;
                    padding-bottom: 1rem
                }

                .md\:text-3xl {
                    font-size: 1.875rem;
                    line-height: 2.25rem
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
        <div id="preloading-game" style="overflow: hidden; width: 100%; height: 100%;">
            <div id="game-page-loader" class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-primary loader_action">
                <div class="h-14 w-14 animate-spin">
                    <img class="loader_action_img" src="<?php echo \helper\options::options_by_key_type('favicon') ? \helper\options::options_by_key_type('favicon') : '/cache/data/image/no_image-s100x100.png' ?>" title="loading" alt="loading img">
                </div>
            </div>

            <div class="relative w-full h-full overflow-hidden">
                <div class="absolute bottom-0 left-0 right-0 top-0 overflow-hidden">
                    <div class="absolute bottom-0 left-0 right-0 top-0 animate-pulse blur-[15px]">
                        <img class="w-full object-cover" width="256" height="156" src="<?php echo \helper\image::get_thumbnail($game->image, 256, 156, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 top-0 bg-gradient-to-br from-blue-600/50 via-purple-600/50 to-black/70"></div>
                    <div class="absolute bottom-0 left-0 right-0 top-0 flex flex-col items-center justify-center gap-4 md:gap-6">
                        <img class="transform rounded-lg shadow-lg transition-transform duration-300 hover:scale-105" width="256" height="156" src="<?php echo \helper\image::get_thumbnail($game->image, 256, 156, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                        <h2 class="text-shadow-lg text-2l font-bold text-white md:text-3xl"><?php echo $game_name; ?></h2>
                        <button onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'start_game_frame()' ?>" aria-label="play game" class="min-w-[200px] transform rounded-full bg-gradient-to-r from-green-400 to-blue-500 px-6 py-3 text-lg font-semibold text-white shadow-lg transition-all duration-300 ease-in-out hover:scale-105 hover:animate-none hover:from-blue-500 hover:to-green-400 hover:shadow-xl md:px-10 md:py-4">Play Game Now</button>
                    </div>
                    <div class="pointer-events-none absolute left-0 top-0 h-full w-full">
                        <div class="animate-float absolute left-1/4 top-1/4 h-8 w-8 rounded-full bg-yellow-300 opacity-50"></div>
                        <div class="animate-float animation-delay-2000 absolute right-1/4 top-3/4 h-6 w-6 rounded-full bg-blue-300 opacity-50"></div>
                        <div class="animate-float animation-delay-4000 absolute bottom-1/4 left-1/3 h-10 w-10 rounded-full bg-purple-300 opacity-50"></div>
                    </div>
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
            }, 600); // 1000 == (1s)

            document.addEventListener('DOMContentLoaded', function() {
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    setTimeout(() => {
                        start_game_frame();
                    }, 600); // 1000 convert (s)
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
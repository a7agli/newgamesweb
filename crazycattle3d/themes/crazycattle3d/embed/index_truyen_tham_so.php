<?php
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


// Lưu ý: list các site không có embed btn play: phần tử(url) phải bỏ "www." || đường dẫn phụ/con đi
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

$list_not_hide_footer_mobi = [
    'crazygames.com',
];
$check_not_hide_footer_mobi = check_list($list_not_hide_footer_mobi, $game->source_html);
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
if ($_GET['referrer']) {
    $game_referrer = $_GET['referrer'];
}
// 22_loading_btn_animation_square: background: img blur black + loading css
// layout: background img blur black - name - img - btn_animation, bg gradient  + loading css
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
        <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
        <!-- <meta name="referrer" content="no-referrer"> -->
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

            :root {
                --tw-text-opacity: 1;
                --rounded-btn: 15px;
                --fallback-bc: #1f2937;
                --bc: 19.7021% 0 0;
                --b2: 91.6146% 0 0;
                /* --fallback-p: #491eff;
                --fallback-s: #ff41c7; */
                --fallback-p: rgba(255, 115, 0, 0.86);
                --fallback-s: rgba(98, 0, 226, 0.86);
                --tw-gradient-from-position: ;
                --tw-gradient-to-position: ;

                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --p: 71.9% .357 330.759573;
                --s: 73.37% .224 48.250878;
            }

            .game-container {
                position: relative;
                height: 100%;
            }

            .img-bg {
                display: block;
                vertical-align: middle;
                max-width: 100%;
                width: 100%;
                height: 100%;
                position: absolute;
                inset: 0;
                -o-object-fit: cover;
                object-fit: cover;
            }

            .facade-content {
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: opacity .3s ease-out;
                background: #000000bf;
            }

            .facade-content-center {
                z-index: 10;
                padding-left: 15px;
                padding-right: 15px;
                text-align: center;
            }

            .game-title {
                display: block;
                margin-bottom: 15px;
                font-size: 30px;
                line-height: 48px;
                font-weight: 700;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1));
                text-transform: capitalize;
            }

            @media (min-width: 1024px) {
                .game-title {
                    font-size: 64px;
                    line-height: 1;
                }
            }

            .game-img {
                display: block;
                vertical-align: middle;
                max-width: 100%;
                height: auto;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 15px;
                border-radius: 2px;
            }

            .game-btn {
                display: inline-flex;
                flex-shrink: 0;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                border-color: oklch(var(--btn-color, var(--b2)) / 1);
                text-align: center;
                line-height: 18px;
                gap: .5rem;
                font-weight: 600;
                outline-color: var(--fallback-bc, oklch(var(--bc) / 1));
                background-color: oklch(var(--btn-color, var(--b2)) / 1);
                height: 56px;
                min-height: 56px;
                padding-left: 32px;
                padding-right: 32px;
                font-size: 16px;

                position: relative;
                animation: pulse-scale 2s ease-in-out infinite;
                border-radius: 9999px;
                border-width: 0px;
                background-image: linear-gradient(to right, var(--tw-gradient-stops));
                --tw-gradient-from: var(--fallback-p, oklch(var(--p) / 1)) var(--tw-gradient-from-position);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
                --tw-gradient-to: var(--fallback-s, oklch(var(--s) / 1)) var(--tw-gradient-to-position);
                color: #fffc;
                --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                --tw-shadow-color: var(--fallback-p, oklch(var(--p) / .5));
                --tw-shadow: var(--tw-shadow-colored);
                transition-property: all;
                transition-timing-function: cubic-bezier(.4, 0, .2, 1);
                transition-duration: .3s;

                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            .game-btn:before,
            .game-btn:after {
                content: "";
                position: absolute;
                inset: -4px;
                border-radius: 9999px;
                background: linear-gradient(45deg, var(--p) 0%, var(--s) 100%);
                opacity: 0;
                transition: opacity .3s ease;
                z-index: -1;
            }

            .game-btn:after {
                filter: blur(12px);
            }

            @keyframes pulse-scale {

                0%,
                to {
                    transform: scale(1)
                }

                50% {
                    transform: scale(1.05)
                }
            }

            .game-btn-flex {
                display: flex;
                align-items: center;
                gap: .5rem;
            }

            .game-btn-flex-svg {
                display: block;
                vertical-align: middle;
                width: 1.5rem;
                height: 1.5rem;
            }

            .game-btn:hover {
                --tw-gradient-to: var(--fallback-s, oklch(var(--s)/.8)) var(--tw-gradient-to-position);
                color: rgb(255 255 255 / var(--tw-text-opacity, 1));
                --tw-shadow: 0 20px 25px -5px rgb(0 0 0 / .1), 0 8px 10px -6px rgb(0 0 0 / .1);
                --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
                --tw-shadow-color: var(--fallback-p, oklch(var(--p)/.6));
                --tw-shadow: var(--tw-shadow-colored);
            }

            @media (min-width: 640px) {
                .game-title {
                    font-size: 48px;
                }

                .game-btn {
                    height: 64px;
                    min-height: 64px;
                    padding-left: 48px;
                    padding-right: 48px;
                    font-size: 18px;
                }
            }

            /* loading */
            .loading_wrap {
                position: absolute;
                inset: 0;
                z-index: 20;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .backdrop-blur-sm {
                position: absolute;
                inset: 0;
                background-color: #000c;
                --tw-backdrop-blur: blur(4px);
                -webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
                backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);
            }

            .loading_box {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .loading-spinner {
                pointer-events: none;
                display: inline-block;
                aspect-ratio: 1 / 1;
                background-color: currentColor;
                -webkit-mask-size: 100%;
                mask-size: 100%;
                -webkit-mask-repeat: no-repeat;
                mask-repeat: no-repeat;
                -webkit-mask-position: center;
                mask-position: center;
                -webkit-mask-image: url("data:image/svg+xml,%3Csvg width='24' height='24' stroke='black' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cg transform-origin='center'%3E%3Ccircle cx='12' cy='12' r='9.5' fill='none' stroke-width='3' stroke-linecap='round'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 12 12' to='360 12 12' dur='2s' repeatCount='indefinite'/%3E%3Canimate attributeName='stroke-dasharray' values='0,150;42,150;42,150' keyTimes='0;0.475;1' dur='1.5s' repeatCount='indefinite'/%3E%3Canimate attributeName='stroke-dashoffset' values='0;-16;-59' keyTimes='0;0.475;1' dur='1.5s' repeatCount='indefinite'/%3E%3C/circle%3E%3C/g%3E%3C/svg%3E");
                mask-image: url("data:image/svg+xml,%3Csvg width='24' height='24' stroke='black' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cg transform-origin='center'%3E%3Ccircle cx='12' cy='12' r='9.5' fill='none' stroke-width='3' stroke-linecap='round'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 12 12' to='360 12 12' dur='2s' repeatCount='indefinite'/%3E%3Canimate attributeName='stroke-dasharray' values='0,150;42,150;42,150' keyTimes='0;0.475;1' dur='1.5s' repeatCount='indefinite'/%3E%3Canimate attributeName='stroke-dashoffset' values='0;-16;-59' keyTimes='0;0.475;1' dur='1.5s' repeatCount='indefinite'/%3E%3C/circle%3E%3C/g%3E%3C/svg%3E");
                width: 128px;
                height: 128px;
                --tw-text-opacity: 1;
                color: var(--fallback-p, oklch(var(--p)/var(--tw-text-opacity, 1)));
                transition: opacity .3s ease;
            }

            .loading_text {
                margin-top: 24px;
                font-size: 20px;
                line-height: 28px;
                font-weight: 500;
                color: #ffffffe6;
            }

            .hidden {
                display: none;
            }

            /* hide_footer: 38px - 45px */
            body.hide_footer {
                height: calc(100% + 41px) !important;
                overflow: hidden !important;
            }

            <?php
            if ($check_not_hide_footer_mobi) {
                echo '@media(max-width: 768px) {
                    body.hide_footer {
                        height: 100% !important;
                        overflow: unset !important;
                    }
                }';
            } ?>
            /* *** */
            <?php
            if (strpos($game->source_html, "gameflare.com")) {
                echo 'body.hide_footer {
                        height: calc(100% + 35px) !important;
                        overflow: hidden !important;
                    }';
            } ?>
        </style>

    </head>

    <body>

        <div id="preloading-game">
            <img id="background_img" class="img-bg" src="<?php echo \helper\image::get_thumbnail($game->image, 400, 300, "m"); ?>" alt="<?php echo $game_name; ?> background">
            <?php if ($game_type === 'EXTERNAL' || ($game_type !== 'IFRAME_HTML'  && $check_load_now === false)) : ?>
                <div id="infor_box" class="facade-content">
                    <div class="facade-content-center">
                        <strong class="game-title"><?php echo $game_name; ?></strong>
                        <img class="game-img" src="<?php echo \helper\image::get_thumbnail($game->image, 144, 144, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?>">
                        <button class="game-btn" onclick="<?php echo ($game_type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(true)' ?>" aria-label="Play Game">
                            <span class="game-btn-flex">
                                Play Now
                                <svg xmlns="http://www.w3.org/2000/svg" class="game-btn-flex-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <div id="loading_wrap" class="loading_wrap hidden">
                <div class="backdrop-blur-sm"></div>
                <div class="loading_box">
                    <div class="loading-spinner"></div>
                    <p class="loading_text">Loading...</p>
                    <p class="loading_text">The game will be ready soon!</p>
                </div>
            </div>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let game_referrer = "<?php echo $game_referrer ?>";
            console.log(game_referrer);

            document.addEventListener('DOMContentLoaded', function() {
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    loading_game(false)
                }
            })

            function loading_game(check) {
                if (check && document.getElementById('infor_box')) {
                    document.getElementById('infor_box').remove();
                }
                if (document.getElementById('loading_wrap')) {
                    document.getElementById('loading_wrap').classList.remove('hidden');
                }

                start_game_frame()

                setTimeout(() => {
                    if (document.getElementById('background_img')) {
                        document.getElementById('background_img').remove();
                    }
                    if (document.getElementById('loading_wrap')) {
                        document.getElementById('loading_wrap').remove();
                    }
                }, 1240);
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

                // test: played www.snokido.com, ads: crazygames.com
                if (game_referrer === '1') {
                    frame_game.setAttribute('referrerPolicy', 'no-referrer');
                }
                document.body.append(frame_game);

                if (game_type === 'HIDE_FOOTER') {
                    document.querySelector('body').className = "hide_footer";
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
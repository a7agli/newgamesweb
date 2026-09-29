<?php
// 23_loader_excerpt_square: background: img blur pink + loader width
// layout: background img blur pink - btn hover beauti - excerpt - img - name + loader width

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
            * {margin: 0;padding: 0;box-sizing: border-box;font-family: Helvetica, Arial, Roboto, sans-serif;}html, body {width: 100%;height: 100%;background: #000;background-color: #000;overflow: hidden;}:root {--tw-border-spacing-x: 0;--tw-border-spacing-y: 0;--tw-translate-x: 0;--tw-translate-y: 0;--tw-rotate: 0;--tw-skew-x: 0;--tw-skew-y: 0;--tw-scale-x: 1;--tw-scale-y: 1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness: proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: rgba(59, 130, 246, .5);--tw-ring-offset-shadow: 0 0 #0000;--tw-ring-shadow: 0 0 #0000;--tw-shadow: 0 0 #0000;--tw-shadow-colored: 0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: ;--background: 0 0% 100%;--foreground: 222.2 47.4% 11.2%;--card: 0 0% 100%;--card-foreground: 222.2 47.4% 11.2%;--popover: 0 0% 100%;--popover-foreground: 222.2 47.4% 11.2%;--primary: 222.2 47.4% 11.2%;--primary-foreground: 210 40% 98%;--secondary: 210 40% 96.1%;--secondary-foreground: 222.2 47.4% 11.2%;--muted: 210 40% 96.1%;--muted-foreground: 215.4 16.3% 46.9%;--accent: 210 40% 96.1%;--accent-foreground: 222.2 47.4% 11.2%;--destructive: 0 100% 50%;--destructive-foreground: 210 40% 98%;--border: 214.3 31.8% 91.4%;--input: 214.3 31.8% 91.4%;--ring: 215 20.2% 65.1%;--radius: 0.5rem }.embed_wrap {position: relative;overflow: hidden;background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));--tw-gradient-from: rgba(170, 76, 143, .1) var(--tw-gradient-from-position);--tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);--tw-gradient-to: hsla(0, 0%, 100%, .05) var(--tw-gradient-to-position);box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);--tw-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25);--tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);width: 100%;height: 100%;background-size: cover;background-position: center;backdrop-filter: blur(10px) }.backdrop_blur {position: absolute;inset: 0;background-color: rgba(170, 76, 143, .5);--tw-backdrop-blur: blur(12px);-webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);}.infor_box {position: absolute;inset: 0;display: flex;align-items: center;justify-content: center;flex-direction: column;}.btn_play {position: relative;cursor: pointer;display: flex;align-items: center;gap: .75rem;overflow: hidden;border-radius: 16px;--tw-bg-opacity: 1;background-color: rgb(170 76 143/var(--tw-bg-opacity, 1));padding: 20px 40px;font-size: 20px;line-height: 28px;font-weight: 700;--tw-text-opacity: 1;color: rgb(255 255 255 / var(--tw-text-opacity, 1));box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);--tw-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 8px 10px -6px rgba(0, 0, 0, .1);--tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);transition-property: all;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .3s;animation-duration: .3s;border: none;}.btn_play_span {position: absolute;inset: 0;opacity: 0;transition-property: opacity;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .3s;animation-duration: .3s;}.btn_play_span1 {background-image: linear-gradient(to right, var(--tw-gradient-stops));--tw-gradient-from: rgba(170, 76, 143, .5) var(--tw-gradient-from-position);--tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);--tw-gradient-to: rgba(170, 76, 143, .2) var(--tw-gradient-to-position);}.btn_play_span2 {background-color: hsla(0, 0%, 100%, .1);}.btn_play_svg {display: block;vertical-align: middle;transition-property: transform;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .3s;animation-duration: .3s;font-size: 48px;line-height: 1;}.btn_play_span3 {position: relative;z-index: 10;transition-property: all;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .3s;animation-duration: .3s;font-size: 30px;line-height: 36px;}.btn_play_span4 {position: absolute;bottom: 0;left: 0;height: 4px;width: 100%;transform-origin: left;--tw-scale-x: 0;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));background-color: hsla(0, 0%, 100%, .2);transition-property: transform;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .3s;animation-duration: .3s;}.btn_play:hover {--tw-translate-y: -2px;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));--tw-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25);--tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);}.btn_play:hover .btn_play_span {opacity: 1;}.btn_play:hover .btn_play_svg {--tw-scale-x: 1.1;--tw-scale-y: 1.1;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));}.btn_play:hover .btn_play_span3 {letter-spacing: .05em;}.btn_play:hover .btn_play_span4 {--tw-scale-x: 1;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));}.excerpt {border-radius: 12px;color: hsla(0, 0%, 100%, .9);background-color: hsla(0, 0%, 100%, .1);padding: 12px 24px;text-align: center;--tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -4px rgba(0, 0, 0, .1);--tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);-webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);--tw-backdrop-blur: blur(4px);font-size: 16px;line-height: 26px;--tw-space-y-reverse: 0;margin-top: calc(2rem* calc(1 - var(--tw-space-y-reverse)));margin-bottom: calc(2rem* var(--tw-space-y-reverse));width: 100%;max-width: 600px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}.infor_box_item {margin-left: auto;margin-right: auto;margin-top: 32px;width: 100%;max-width: 210px;padding: 0 24px;}.game_item {position: relative;overflow: hidden;border-radius: 12px;transition-property: transform;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .3s;animation-duration: .3s;cursor: pointer;}.game_item_img {border-color: hsl(var(--border));aspect-ratio: 1 / 1;overflow: hidden;border-radius: 12px;}.game_item_img img {display: block;vertical-align: middle;max-width: 100%;width: 100%;height: 100%;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));-o-object-fit: cover;object-fit: cover;transition-property: transform;transition-timing-function: cubic-bezier(.4, 0, .2, 1);transition-duration: .5s;animation-duration: .5s;}.game_item_name {margin-top: 8px;}.game_item_name p {font-size: 16px;line-height: 18px;color: hsla(0, 0%, 100%, .9);text-align: center;text-transform: capitalize;}.game_item:hover {--tw-scale-x: 1.05;--tw-scale-y: 1.05;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));}.game_item:hover img {--tw-scale-x: 1.1;--tw-scale-y: 1.1;transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));}@media (max-width: 640px) {.btn_play_span3 {font-size: 20px;}.btn_play_svg {width: 30px;height: 30px;}}.loading_wrap {margin-left: auto;margin-right: auto;width: 100%;max-width: 600px;padding: 30px;border-radius: 16px;border-width: 1px;border-color: hsla(0, 0%, 100%, .1);background-color: rgba(170, 76, 143, .3);box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);--tw-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 8px 10px -6px rgba(0, 0, 0, .1);--tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);--tw-backdrop-blur: blur(12px);-webkit-backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia);}.loading_name {margin-bottom: 24px;background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));--tw-gradient-from: #aa4c8f var(--tw-gradient-from-position);--tw-gradient-stops: var(--tw-gradient-from), #ec4899 var(--tw-gradient-via-position), var(--tw-gradient-to);--tw-gradient-to: #a855f7 var(--tw-gradient-to-position);-webkit-background-clip: text;background-clip: text;text-align: center;font-weight: 700;color: transparent;font-size: 24px;line-height: 32px;text-transform: capitalize;}.loading_bar {position: relative;height: 24px;overflow: hidden;border-radius: 9999px;background-color: rgba(0, 0, 0, .4);}.loading_bar_style {position: absolute;left: 0;top: 0;height: 100%;padding-right: 12px;display: flex;align-items: center;justify-content: flex-end;background-image: linear-gradient(to right, var(--tw-gradient-stops));--tw-gradient-from: #fbcfe8 var(--tw-gradient-from-position);--tw-gradient-to: #aa4c8f var(--tw-gradient-to-position);--tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);transition-property: all;transition-duration: .3s;transition-timing-function: cubic-bezier(0, 0, .2, 1);animation-duration: .3s;animation-timing-function: cubic-bezier(0, 0, .2, 1);}.loading_bar_text {font-size: 16px;line-height: 20px;font-weight: 700;--tw-text-opacity: 1;color: rgb(255 255 255 / var(--tw-text-opacity, 1));}.hidden {display: none;}

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

        <div id="preloading-game" class="embed_wrap" style="background-image: url(<?php echo \helper\image::get_thumbnail($game->image, 400, 250, "m"); ?>);">
            <div class="backdrop_blur"></div>

            <?php if ($game_type !== 'IFRAME_HTML'  || $check_load_now === false) : ?>
                <div id="infor_box" class="infor_box">
                    <button class="btn_play" aria-label="Start Game" onclick="<?php echo ($game_type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game2(1.8)' ?>">
                        <span class="btn_play_span btn_play_span1"></span>
                        <span class="btn_play_span btn_play_span2"></span>
                        <svg class="btn_play_svg" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M483.13 245.38C461.92 149.49 430 98.31 382.65 84.33A107.13 107.13 0 0 0 352 80c-13.71 0-25.65 3.34-38.28 6.88C298.5 91.15 281.21 96 256 96s-42.51-4.84-57.76-9.11C185.6 83.34 173.67 80 160 80a115.74 115.74 0 0 0-31.73 4.32c-47.1 13.92-79 65.08-100.52 161C4.61 348.54 16 413.71 59.69 428.83a56.62 56.62 0 0 0 18.64 3.22c29.93 0 53.93-24.93 70.33-45.34 18.53-23.1 40.22-34.82 107.34-34.82 59.95 0 84.76 8.13 106.19 34.82 13.47 16.78 26.2 28.52 38.9 35.91 16.89 9.82 33.77 12 50.16 6.37 25.82-8.81 40.62-32.1 44-69.24 2.57-28.48-1.39-65.89-12.12-114.37zM208 240h-32v32a16 16 0 0 1-32 0v-32h-32a16 16 0 0 1 0-32h32v-32a16 16 0 0 1 32 0v32h32a16 16 0 0 1 0 32zm84 4a20 20 0 1 1 20-20 20 20 0 0 1-20 20zm44 44a20 20 0 1 1 20-19.95A20 20 0 0 1 336 288zm0-88a20 20 0 1 1 20-20 20 20 0 0 1-20 20zm44 44a20 20 0 1 1 20-20 20 20 0 0 1-20 20z"></path>
                        </svg>
                        <span class="btn_play_span3">Start Game</span>
                        <span class="btn_play_span4"></span>
                    </button>
                    <?php echo $game->excerpt ? '<p class="excerpt">' . $game->excerpt . '</p>' : '' ?>
                    <div class="infor_box_item" onclick="<?php echo ($game_type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game2(1.8)' ?>">
                        <div class="game_item">
                            <div class="game_item_img">
                                <img src="<?php echo \helper\image::get_thumbnail($game->image, 170, 170, "m"); ?>" width="170" height="170" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                            </div>
                            <div class="game_item_name">
                                <p><?php echo $game_name; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div id="loading_box" class="infor_box hidden">
                <div class="loading_wrap">
                    <div class="loading_name"><?php echo $game_name; ?></div>
                    <div class="loading_bar">
                        <div id="loading_bar_style" class="loading_bar_style" style="width: 0%;">
                            <span id="loading_bar_text" class="loading_bar_text">0%</span>
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
                if ((game_type != 'EXTERNAL' && check_load_now) || game_type == 'IFRAME_HTML') {
                    loading_game2(1.8)
                }
            })

            function loading_game2(duration) {
                if (document.getElementById("infor_box")) {
                    document.getElementById("infor_box").remove();
                }
                if (document.getElementById("loading_box")) {
                    document.getElementById("loading_box").classList.remove('hidden');
                }

                start_game_frame();

                loading_game(duration);
            }

            function loading_game(duration) {
                const loading_bar_style = document.getElementById('loading_bar_style');
                const loading_bar_text = document.getElementById('loading_bar_text');
                let currentCount = 0; // Start at 0

                function animate() {
                    const startTime = performance.now(); // Get start time

                    function updateProgress() {
                        const elapsedTime = (performance.now() - startTime) / 1000; // Time in seconds
                        const progress = Math.min(elapsedTime / duration, 1); // Progress (0 to 1)
                        currentCount = Math.floor(progress * 100); // Calculate current count (0 to 21)
                        loading_bar_style.style.width = `${currentCount}%`;
                        loading_bar_text.innerHTML = `${currentCount}%`;

                        if (currentCount < 100) {
                            requestAnimationFrame(updateProgress); // Update again if not finished
                        }
                        if (currentCount >= 100) {
                            if (document.getElementById("preloading-game")) {
                                document.getElementById("preloading-game").remove();
                            }
                        }
                    }
                    updateProgress();
                }
                requestAnimationFrame(animate);
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
            }

            function openInNewWindow() {
                let height2 = window.innerHeight || 600;
                let width2 = window.innerWidth || 600;
                window.open(url_game, "", "width=" + width2 + ",height=" + height2);
            }
        </script>
    </body>

    </html>
<?php endif; ?>
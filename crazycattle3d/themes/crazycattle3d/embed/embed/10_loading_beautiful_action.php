<?php
// 10_loading_beautiful_action: background: img blur(blue purple) + btn action
// layout: background: svg - img(loading animation - show img game) - name - btn action

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
                font-family: Helvetica, Arial, Roboto, sans-serif;
            }

            html,
            body {
                width: 100%;
                height: 100%;
                background: #000;
                background-color: #000;
            }

            .PlayButton_container__MiBq1 {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                margin-bottom: auto;
                transition: none;
                overflow: hidden
            }

            .PlayButton_container__MiBq1:before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                background: linear-gradient(142deg, rgba(61, 99, 205, .5), rgba(100, 36, 219, .5)), rgba(0, 0, 0, .7);
                z-index: 2
            }

            .PlayButton_imgBackground__Yldp3 {
                position: relative;
                width: 100%;
                height: 100%;
                filter: blur(10px)
            }

            .PlayButton_imgBackground__Yldp3 img {
                width: 100%;
                height: 100%;
                object-position: center;
                object-fit: fill
            }

            .PlayButton_video__qphho {
                object-fit: cover;
                width: 100%;
                min-height: 100%
            }

            .PlayButton_contentContainer__iaiRH {
                position: absolute;
                z-index: 2;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                margin: auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 12px
            }

            @media(min-width: 768px) {
                .PlayButton_contentContainer__iaiRH {
                    gap: 16px
                }
            }

            .PlayButton_imageContainer__xeWej {
                position: relative;
                width: 160px;
                height: 96px;
                border-radius: 8px;
                overflow: hidden
            }

            .PlayButton_imageLoader__gkCWJ {
                position: absolute;
                top: 0;
                left: 0;
                width: 160px;
                height: 96px;
                border-radius: 8px;
                background-color: #5920c5;
            }

            .PlayButton_imageLoader__gkCWJ:after {
                content: "";
                display: block;
                position: absolute;
                top: calc(50% - 19px);
                left: calc(50% - 19px);
                width: 34px;
                height: 34px;
                border-radius: 50%;
                border: 4px solid #fff;
                border-right-color: transparent;
                animation: PlayButton_spin__pLZV5 1s infinite
            }

            .PlayButton_smallImg__Rr1wP {
                border-radius: 8px
            }

            .PlayButton_title__j4bUo {
                font-weight: 700;
                font-size: 16px;
                color: #fff;
                text-align: center;
                text-transform: capitalize;
            }

            @media(min-width: 768px) {
                .PlayButton_title__j4bUo {
                    font-size: 28px
                }
            }

            .PlayButton_btnContainer__DSUNb {
                display: flex;
                align-items: center;
                gap: 8px;
                min-width: 185px;
                max-height: 60px;
                width: max-content;
                padding: 8px;
                z-index: 3;
                border-radius: 70px;
                background: linear-gradient(94.63deg, #3d63cd 10.2%, #6424db 89.98%);
                box-shadow: 6px 2px 20px 0 hsla(0, 0%, 4%, .3);
                cursor: pointer;
                overflow: hidden;
                position: relative;
                border: none;
            }

            .PlayButton_btnText__81nj6 {
                color: #fff;
                font-size: 24px;
                font-weight: 700;
                line-height: 120%;
                margin-top: -4px;
                text-align: center;
                min-height: 24px;
                max-height: 24px
            }

            .PlayButton_btnContainer__DSUNb .PlayButton_btnText__81nj6 {
                padding-right: 8px
            }

            @media(min-width: 768px) {
                .PlayButton_btnContainer__DSUNb {
                    margin-top: 8px;
                    gap: 12px;
                    padding-left: 10px
                }
            }

            @media(min-width: 1024px) {
                .PlayButton_btnContainer__DSUNb:hover {
                    animation-name: PlayButton_pulse-grow-on-hover__qKNiD;
                    animation-duration: .3s;
                    animation-timing-function: ease-out;
                    animation-iteration-count: infinite;
                    animation-direction: alternate;
                    animation-fill-mode: backwards
                }
            }

            @keyframes PlayButton_pulse-grow-on-hover__qKNiD {
                to {
                    transform: scale(1.1)
                }
            }

            .PlayButton_btnContainer__DSUNb .PlayButton_iconAnimationWrapper__uFvD7 {
                display: flex;
                align-items: center;
                position: relative;
                left: 0;
                transition: left .3s, transform .3s
            }

            .PlayButton_btnContainer__DSUNb .PlayButton_iconAnimationWrapper__uFvD7 span.PlayButton_spinnerWrapper__uDhjE {
                display: block;
                width: 46px;
                height: 46px;
                border-radius: 50%;
                background: #fff;
                position: absolute;
                top: 0;
                left: 0;
                visibility: hidden;
                transition: all .3s
            }

            .PlayButton_btnContainer__DSUNb .PlayButton_iconAnimationWrapper__uFvD7 span.PlayButton_spinnerWrapper__uDhjE:before {
                content: "";
                display: block;
                position: absolute;
                top: 5px;
                left: 5px;
                right: 5px;
                bottom: 5px;
                border-radius: 50%;
                border: 4px solid #5920c5;
                border-left: 4px solid transparent;
                animation: PlayButton_spin__pLZV5 .8s linear infinite
            }

            @keyframes PlayButton_spin__pLZV5 {
                0% {
                    transform: rotate(0deg)
                }

                to {
                    transform: rotate(1turn)
                }
            }

            .PlayButton_btnContainer__DSUNb svg {
                transition: all .3s
            }

            .PlayButton_btnContainer__DSUNb.PlayButton_clicked__CJRNZ {
                cursor: default;
                background: #5920c5
            }

            .PlayButton_btnContainer__DSUNb.PlayButton_clicked__CJRNZ .PlayButton_btnText__81nj6 {
                visibility: hidden
            }

            .PlayButton_btnContainer__DSUNb.PlayButton_clicked__CJRNZ .PlayButton_iconAnimationWrapper__uFvD7 {
                left: 100%;
                transform: translateX(-100%)
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
        <div id="preloading-game" class="PlayButton_container__MiBq1">
            <div class="PlayButton_imgBackground__Yldp3">
                <img width="160" height="96" class="PlayButton_video__qphho" src="<?php echo \helper\image::get_thumbnail($game->image, 160, 96, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> background" />
            </div>
            <div class="PlayButton_contentContainer__iaiRH">
                <div class="PlayButton_imageContainer__xeWej">
                    <div id="game-page-loader" class="PlayButton_imageLoader__gkCWJ"></div>
                    <img style="color: transparent;" width="160" height="96" class="PlayButton_smallImg__Rr1wP" src="<?php echo \helper\image::get_thumbnail($game->image, 160, 96, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                </div>
                <p class="PlayButton_title__j4bUo"><?php echo $game_name; ?></p>
                <?php if ($game->type != 'IFRAME_HTML') : //PlayButton_btnContainer__DSUNb PlayButton_clicked__CJRNZ
                ?>
                    <button id="btn_play" class="PlayButton_btnContainer__DSUNb" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'loading_game(0.5)' ?>" aria-label="play game">
                        <span class="PlayButton_iconAnimationWrapper__uFvD7">
                            <svg width="46" height="46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23 .25C10.456.25.25 10.456.25 23S10.456 45.75 23 45.75 45.75 35.544 45.75 23 35.544.25 23 .25Zm8.178 23.767L18.66 31.58a1.179 1.179 0 0 1-1.785-1.018V15.44a1.178 1.178 0 0 1 1.785-1.018l12.518 7.562a1.19 1.19 0 0 1 0 2.034Z" fill="#fff"></path>
                            </svg>
                            <span class="PlayButton_spinnerWrapper__uDhjE"></span>
                        </span>
                        <span class="PlayButton_btnText__81nj6">Play now</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            if (document.getElementById("game-page-loader")) {
                setTimeout(() => {
                    if (document.getElementById("game-page-loader")) {
                        document.getElementById("game-page-loader").remove();
                    }
                }, 420); // 1000 == (1s)
            }

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
                    document.getElementById("btn_play").classList.toggle("PlayButton_clicked__CJRNZ");
                }
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
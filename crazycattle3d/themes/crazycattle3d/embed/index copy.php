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
$list_not_embed = [
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
$check_not_embed = check_list($list_not_embed, $game->source_html);

$game_type = $game->type;

// check types: có thanh ads ở cuối
$check_footer_ads = false;
$list_footer_ads = [
    'FooterAds',
    'FooterAds_NoMobile',
    'AdsExt_FooterAds',
    'AdsExt_FooterAds_NoM',
];
$check_footer_ads = in_array($game_type, $list_footer_ads);
// in($game_type);
// in($check_footer_ads);

// check types: KHÔNG có thanh ads ở cuối (màn Mobile)
$check_FooterAds_NoMobile = false;
$list_FooterAds_NoMobile = [
    'FooterAds_NoMobile',
    'AdsExt_FooterAds_NoM',
];
$check_FooterAds_NoMobile = in_array($game_type, $list_FooterAds_NoMobile);

// JS: cho nó attribute sandbox: ngăn mở liên kết ngoài
$check_ads_external = false;
$list_types_ads_ext = [
    'AdsExt', // www.y8.com
    'AdsExt_FooterAds', //gameflare.com
    'AdsExt_FooterAds_NoM', //crazygames.com
];
$check_ads_ext = in_array($game_type, $list_types_ads_ext);
$list_fix = [
    'y8.com',
    'gameflare.com',
    // 'crazygames.com', //Nếu sd attr: 'referrerPolicy', 'no-referrer' thì có thể bỏ
];
$check_ads_ext_hardcode = check_list($list_fix, $game->source_html);
if ($check_ads_ext || $check_ads_ext_hardcode) {
    $check_ads_external = true;
}

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
// 20_loader_att_svg_logo: background: img blur + btn loader
// layout: background blur: img - logo - loading attribute svg wrap: img - name - flip effect btn
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


            #loader {
                position: relative;
                overflow: hidden;
                width: 100%;
                height: 500px;
                margin: auto;
                color: #fff;
                text-align: left
            }

            .preview .noglow {
                width: 100%;
                height: auto;
                max-width: 900px;
                opacity: 0.8;
                margin: auto
            }

            .preview .glow {
                width: 100%;
                height: auto;
                max-width: 900px;
                text-align: center;
                filter: blur(60px) brightness(1.5);
                opacity: 0.8
            }

            .preview .play {
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                display: flex;
                flex-direction: column
            }

            .preview .playimg {
                overflow: hidden;
                width: 190px;
                margin: 50px auto 0 auto;
                border: solid 2px rgba(255, 255, 255, 0.4);
                border-radius: 20px
            }

            #playGame {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                cursor: pointer
            }

            .playBT {
                display: flex;
                justify-content: center;
                align-items: center;
                max-width: 190px;
                width: 100%;
                height: 60px;
                padding: 0 20px;
                margin: 20px auto 50px auto;
                border-radius: 30px;
                background-color: rgba(0, 0, 0, 0.8);
                box-shadow: 0 0 8px 0 rgba(0, 0, 0, 0.3);
                transition: all 400ms cubic-bezier(.47, 1.64, .41, .8)
            }
            .playBT span {
                margin: 0 10px;
                color: #f3f3f3;
                font-size: 19px;
                line-height: 19px;
                white-space: nowrap;
                font-weight: 700
            }
            .playBT .icon-arrow {
                font-size: 30px;
                margin-bottom: 6px;
                transition: all 200ms ease
            }
            @keyframes flick {
                0% {
                    opacity: 1
                }

                50% {
                    opacity: 0.5
                }

                100% {
                    opacity: 1
                }
            }
            .icon-arrow:before {
                content: "»";
            }
            .playBT:hover {
                transform: scale(1.1)
            }
            .playBT:hover .icon-arrow {
                margin-left: 20px;
                animation: flick 0.7s infinite
            }
            .playNoglow {
                margin: auto
            }



            /* check_footer_ads: 41px để phù hợp với các site có từ 38px - 45px */
            body.check_footer_ads {
                height: calc(100% + 41px) !important;
                overflow: hidden !important;
            }

            <?php if ($check_FooterAds_NoMobile) {
                echo '@media(max-width: 768px) {
                        body.check_footer_ads {
                            height: 100% !important;
                            overflow: unset !important;
                        }
                    }';
            } ?>
            /* gameflare.com */
            <?php if (strpos($game->source_html, "gameflare.com")) {
                echo 'body.check_footer_ads {
                    height: calc(100% + 35px) !important;
                    overflow: hidden !important;
                }';
            } ?>
        </style>
    </head>

    <body>

        <div id="loader" class="preview">
            <div id="playGame">
                <img class="noglow" src="<?php echo \helper\image::get_thumbnail($game->image, 900, 505, "m"); ?>" alt="<?php echo $game_name; ?> background">
                <div class="play">
                    <div class="playBT playNoglow"><span style="font-size:23px">Play Now</span><span class="icon-arrow"></span></div>
                </div>
            </div>
        </div>

        <!-- <script>
            let game_type = "<?php echo $game->type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_not_embed = "<?php echo $check_not_embed ?>";
            let check_footer_ads = "<?php echo $check_footer_ads ?>";
            let check_ads_external = "<?php echo $check_ads_external ?>";

            document.addEventListener('DOMContentLoaded', function() {
                loading_game()

                if (game_type != 'EXTERNAL' && check_not_embed) {
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

                // test: có thể loại bỏ được dòng chữ giới thiệu sang trang nó chơi ngay dưới nút play now: crazygame, mà ko biết có ảnh hưởng gì nếu game nó có quảng cáo ở iframe hay ko
                frame_game.setAttribute('referrerPolicy', 'no-referrer');
                // frame_game.setAttribute('rel', 'noopener noreferrer'); // test2
                if (check_ads_external) {
                    frame_game.setAttribute('sandbox', 'allow-forms allow-modals allow-same-origin allow-scripts allow-pointer-lock');
                }
                document.body.append(frame_game);

                if (check_footer_ads) {
                    document.querySelector('body').className = "check_footer_ads";
                }

                if (document.getElementById("preloading-game")) {
                    document.getElementById("preloading-game").remove();
                }
                // setTimeout(() => { //wowtbc
                // if (check_footer_ads) {
                //     document.querySelector('body').className = "check_footer_ads";
                // }
                // }, 170);
            }

            // open url: external
            function openInNewWindow() {
                let height2 = window.innerHeight || 600;
                let width2 = window.innerWidth || 600;
                window.open(url_game, "", "width=" + width2 + ",height=" + height2);
            }
        </script> -->
    </body>

    </html>
<?php endif; ?>
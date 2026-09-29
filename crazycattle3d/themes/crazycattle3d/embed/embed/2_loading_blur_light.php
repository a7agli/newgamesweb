<?php
// 2_loading_blur_light: backgroud: img
// layout:backgroud: img - img - btn - loading_text - loading_percent crossbar

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
                font-family: "Helvetica Neue", "Calibri Light", Roboto, sans-serif;
            }

            html,
            body {
                background: #000;
                background-color: #000;
            }

            #iframe-box {
                display: none;
                text-align: center
            }

            .box_play {
                position: absolute;
                top: 35%;
                transform: translateX(-50%);
                width: 100%;
                z-index: 9999;
                text-decoration: none;
            }

            .bt {
                position: absolute;
                transform: translateX(-50%);
                bottom: -50px;
                padding: 10px 15px;
                color: #FFF;
                background-color: #3281ff;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                text-transform: uppercase;
            }

            .bt:hover {
                background-color: #009cff
            }

            .iframe-box-bg {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                -webkit-filter: blur(0.8em);
                filter: blur(0.8em);
                opacity: 0.25;
            }

            .a0 {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                z-index: 1;
                margin: 0 auto;
                background-color: #fff;
                /* background-color: rgba(0, 0, 0, 0.4); */
                padding: 20px;
                height: 100%;
                width: 100%;
            }

            #loading_text {
                /* color: #fff; */
                color: #000;
            }

            .a1 {
                display: table;
                width: 100%;
                height: 100%;
                text-align: center;
            }

            .a3 {
                height: 30px;
                position: fixed;
                bottom: 0;
                left: 0;
                transition: all .3s;
            }

            .o1 {
                background-color: #002b50;
                width: 100%;
                z-index: 2;
            }

            .o2 {
                background-color: #009cff;
                width: 0%;
                z-index: 3;
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

        <div id="ay">
            <div class="a0">
                <div class="a1">
                    <div class="a2">
                        <img width="238" height="140" class="iframe-box-bg" src="<?php echo \helper\image::get_thumbnail($game->image, 238, 140, "m"); ?>" alt="<?php echo $game_name; ?> background" />
                        <a href="javascript:" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'startLoadingGame()' ?>" class="box_play" title="<?php echo $game_name; ?>">
                            <p><img style="max-width: 100%; border-radius: 9px" width="auto" height="auto" src="<?php echo \helper\image::get_thumbnail($game->image, 238, 140, 'm'); ?>" alt="<?php echo $game_name; ?> img" /></p>
                            <span id="btn_play" class="bt">PLAY NOW » </span>
                            <div id="loading_text" style="display: none">
                                <h1>Game loading...</h1>
                                <h2>0%</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="loading_percent" style="display: none">
                <div class="a3 o1"></div>
                <div class="a3 o2"></div>
            </div>
        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            // check url: unnecessary redundancy ==> straight to the game
            document.addEventListener('DOMContentLoaded', function() {
                if (game_type != 'EXTERNAL' && check_load_now) {
                    start_game_frame();
                    if (document.getElementById("ay")) {
                        document.getElementById("ay").remove();
                    }
                } else {
                    if (game_type == 'IFRAME_HTML') {
                        startLoadingGame()
                    }
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
            }

            // open url: external
            function openInNewWindow() {
                let height2 = window.innerHeight || 600;
                let width2 = window.innerWidth || 600;
                window.open(url_game, "", "width=" + width2 + ",height=" + height2);
            }

            // run loading_game
            function startLoadingGame() {
                function loading_game() {
                    document.getElementById("btn_play").style.display = "none";
                    document.getElementById("loading_text").style.display = "block";
                    document.getElementById("loading_percent").style.display = "block";

                    PRELOAD.init({
                        time: 1,
                        stepPerSecond: 20,
                        done: function() {
                            start_game_frame(); // render html

                            var ay = document.querySelector("#ay");
                            ay.parentNode.removeChild(ay);
                        }
                    });
                    PRELOAD.run();
                }

                var PRELOAD = (function(doc) {
                    var TIMER, COUNTER, TOTAL_STEP, AMOUNT;
                    COUNTER = 0;
                    AMOUNT = 0;
                    TOTAL_STEP = 0;
                    var config = {
                        time: 1,
                        stepPerSecond: 20,
                        bgCorver: "#002b50",
                        bgMain: "#009cff",
                        done: function() {
                            console.log("Preload completed.")
                        }
                    };

                    function findOne(str) {
                        return doc.querySelector(str);
                    }

                    function setBackgroundProcess() {
                        var cover, main;
                        cover = findOne(".o1");
                        main = findOne(".o2");
                        if (cover)
                            cover.style.backgroundColor = config.bgCorver;
                        if (main)
                            main.style.backgroundColor = config.bgMain;
                    }

                    function updatePreload(percent) {
                        var main, h1;
                        main = findOne(".o2");
                        h1 = findOne("h2");
                        if (main) {
                            main.style.width = percent + "%";
                            h1.innerHTML = parseInt(percent) + "%";
                        }
                    }

                    function init(option) {
                        config = Object.assign(config, option);
                        setBackgroundProcess();
                        TOTAL_STEP = config.time * config.stepPerSecond;
                        AMOUNT = 100 / TOTAL_STEP;
                    }

                    function loop() {
                        if (++COUNTER > TOTAL_STEP) {
                            clearTimeout(TIMER);
                            config.done();
                            return;
                        }
                        // console.log(COUNTER * AMOUNT)
                        updatePreload(COUNTER * AMOUNT);
                        TIMER = setTimeout(loop, 1e3 / config.stepPerSecond);
                    }

                    return {
                        init: function(option) {
                            init(option);
                        },
                        run: function() {
                            loop();
                        }
                    };
                })(document);
                // Gọi hàm loading_game() khi cần
                loading_game();
            }
        </script>
    </body>

    </html>
<?php endif; ?>
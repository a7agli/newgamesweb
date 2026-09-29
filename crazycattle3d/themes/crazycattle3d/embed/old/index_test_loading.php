<?php
$domain_url = \helper\options::options_by_key_type('base_url');
$site_name = \helper\options::options_by_key_type('site_name');
$theme_url = '/' . DIR_THEME;
$game = \helper\game::find_by_slug($slug);
if ($game->source_html != '') {
    if (strpos($game->source_html, 'gamedistribution') || strpos('gamedistribution', $game->source_html)) {
        $game->source_html = $game->source_html . '?gd_sdk_referrer_url=' . $domain_url . '/' . $game->slug . '.embed';
    }
}
?>


<html lang="en">

<head>
    <title>Play <?php echo $game->name; ?> Game Online !</title>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow, noodp, noydir" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true,IE=Edge,chrome=1" />
    <meta http-equiv="Content-Language" content="en-US" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Helvetica Neue", "Calibri Light", Roboto, sans-serif;
        }

        #missing-flash {
            display: none;
            text-align: center
        }

        .fl-wrap {
            margin: 0 auto;
            background-color: #FFF;
            padding: 20px;
            position: absolute;
            height: 100%;
            width: 100%;
            z-index: 9999;
        }

        .fl-content {
            color: #fff
        }

        .fl-game {
            display: flex;
            height: 95%;
            justify-content: center;
            align-items: center;
        }

        .fl-game a {
            position: absolute;
            z-index: 9999;
            text-decoration: none
        }

        .fl-game span {
            color: #FFF;
            background-color: #3281ff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }

        .fl-game span:hover {
            background-color: #009cff
        }

        .missing-flash-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-filter: blur(0.8em);
            filter: blur(0.8em);
            opacity: 0.25;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            background-color: rgba(0, 0, 0, 0.4);
        }

        .a0 {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 1;
        }

        .a1 {
            display: table;
            width: 100%;
            height: 100%;
            text-align: center;
        }

        .a2 {
            display: table-cell;
            vertical-align: middle;
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

        .enable_flash {
            color: #FFF;
            background-color: #3281ff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            position: absolute;
            top: 200px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff900 !important;
        }

        .bt {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -50px;
        }

        .adobetext {
            top: 250px;
            width: 100%;
        }
    </style>

</head>

<body id="run_IFRAME_HTML">
    <?php if ($game) : ?>

        <?php
        $source = $game->source_file;
        if ($game->type == 'EMBED_SWF') {
            $source = $game->source_html;
        }
        ?>

        <div id="ax" style="display: none">
            <object id="GameEmbedSWF" width="100%" height="100%" data="<?php echo $source; ?>" type="application/x-shockwave-flash">
                <param name="base" value="">
                <param name="wmode" value="direct">
                <param name="movie" value="<?php echo $game->source_file; ?>">
                <param name="menu" value="false">
                <param name="allowNetworking" value="internal">
                <param name="allowScriptAccess" value="never">
                <embed src="<?php echo $source; ?>" menu="false" allownetworking="internal" allowscriptaccess="never" width="100%" height="100%" type="application/x-shockwave-flash">
            </object>
        </div>
        <div id="ay" style="display: none">
            <div class="a0">
                <div class="a1">
                    <div class="a2">
                        <img src="<?php echo \helper\image::get_thumbnail($game->image, 200, 200, 'm'); ?>" style="max-width: 60%">
                        <h1 style="color: #fff">Game loading...</h1>
                        <h2 style="color: #fff">0%</h2>
                    </div>
                </div>
            </div>
            <div class="a3 o1"></div>
            <div class="a3 o2"></div>
        </div>

        <script>
            var PRELOAD = (function(doc) {
                var TIMER, COUNTER, TOTAL_STEP, AMOUNT;
                COUNTER = 0;
                AMOUNT = 0;
                TOTAL_STEP = 0;
                var config = {
                    time: 2,
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
        </script>
        <div id="missing-flash"></div>
        <script type="text/javascript">
            function startGame() {
                var isAllowSWF = false;
                if (isAllowSWF)
                    document.querySelector('#GameEmbedSWF').startGame();
            }

            function preload_complete() {
                setTimeout(startGame, 1e3);
            }
        </script>
        <script>
            var MissingFlashBroswer = function() {
                var dataRenderFlashObjectMissing, str = "";
                dataRenderFlashObjectMissing = {
                    wrapBefore: '<div class="fl-wrap">',
                    wrapAfter: '<div>',
                    imgGame: '<div class="fl-content fl-game">\n\  <img  width="238" height="140" class="missing-flash-bg" src="<?php echo \helper\image::get_thumbnail($game->image, 200, 200, "m"); ?>"/>\n\<a rel="nofollow" class="enable_flash" href="https://howtoenableflash.com/" title="View Details" target="_blank" >How To Enable Flash In Chrome</a> <a href="https://get.adobe.com/flashplayer/" class="adobetext" target="_blank">\n\ <p><img style="    max-width: 100%;" width="auto" height="auto" src="<?php echo "/" . DIR_THEME . "/rs/imgs/active-flash-2.png"; ?>" alt="<?php echo $game->name; ?>"/></p><span class="bt">PLAY NOW » </span></a></div>',
                };
                for (var key in dataRenderFlashObjectMissing)
                    str += dataRenderFlashObjectMissing[key];
                document.getElementById("missing-flash").innerHTML = str;
                document.getElementById("missing-flash").style.display = "block";
            };
        </script>
        <script src="<?php echo $theme_url ?>/rs/js/flash_detect.min.js" type="text/javascript"></script>
        <script>
            window.onload = function() {
                // if (FlashDetect.installed === false) {
                //     document.getElementById("GameEmbedSWF").style.display = 'none';
                //     MissingFlashBroswer();
                // } else {
                document.getElementById("missing-flash").remove();
                document.getElementById("ay").style.display = "block";
                PRELOAD.init({
                    time: 2,
                    stepPerSecond: 20,
                    done: function() {
                        var ax, ay;
                        ay = document.querySelector("#ay");
                        ay.parentNode.removeChild(ay);
                        // ax = document.querySelector("#ax");
                        // ax.style.display = "block";
                        start_game_frame();
                    }
                });
                PRELOAD.run();



                let url_game = "<?php echo $game->source_html ?>";
                let is_game_layer = url_game.includes("gamedistribution") || url_game.includes("crazygame");
                if (is_game_layer) {
                    console.log(11111111)
                    start_game_frame();
                }
                async function start_game_frame() {
                    let frame_game = document.createElement('iframe');
                    frame_game.setAttribute('id', 'iframehtml5');
                    frame_game.setAttribute('width', '100%');
                    frame_game.setAttribute('height', '100%');
                    frame_game.setAttribute('frameborder', '0');
                    frame_game.setAttribute('border', '0');
                    frame_game.setAttribute('scrolling', 'auto');
                    frame_game.setAttribute('class', 'iframe-default');
                    frame_game.setAttribute('allowfullscreen', 'true');
                    frame_game.setAttribute('src', "<?php echo $game->source_html ?>");
                    frame_game.setAttribute('title', "<?php echo $game->name ?>");
                    if (document.getElementById("preloading-game")) {
                        await document.getElementById("preloading-game").remove();
                    }
                    document.body.append(frame_game);
                }
            }

            function open_function() {

            }
            // }
        </script>
    <?php endif; ?>
    <!-- <img src="/count.ajax?id=<?php echo $game->id ?>" style="display:none" /> -->
</body>

</html>
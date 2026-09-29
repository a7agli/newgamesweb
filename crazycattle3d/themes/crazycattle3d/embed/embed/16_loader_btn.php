<?php
// 16_loader_btn: background: color + btn_loader animation
// layout: img - name - btn_loader animation(...) - btn svg play

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

            .gameframe-content {
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -moz-box-orient: vertical;
                -moz-box-direction: normal;
                -webkit-box-pack: center;
                -moz-box-pack: center;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: flex;
                -webkit-flex-direction: column;
                flex-direction: column;
                height: 100%;
                -webkit-justify-content: center;
                justify-content: center;
                width: 100%;
                -webkit-box-align: center;
                -moz-box-align: center;
                -webkit-align-items: center;
                align-items: center;
                /* background-color: #d6f7ff; background-color: #cbeaf2;*/
                background: linear-gradient(to bottom, #d6f7ff, #d0eff7);
            }

            .game-item {
                display: inline-block;
            }

            .game-item .image {
                background-color: rgba(0, 0, 0, .15);
                border-radius: 3px;
                padding: 5px;
            }

            .game-item .image img {
                display: block;
            }

            .game-title {
                color: #333;
                font-size: 1.2em;
                font-weight: 400;
                margin: 5px 0 15px;
                text-transform: capitalize;
            }

            .play-button,
            .play-button-disabled {
                -webkit-box-align: center;
                -moz-box-align: center;
                -webkit-box-pack: center;
                -moz-box-pack: center;
                -webkit-align-items: center;
                align-items: center;
                -webkit-animation: scale-easeOutElastic-reversed .6s;
                -moz-animation: scale-easeOutElastic-reversed .6s;
                animation: scale-easeOutElastic-reversed .6s;
                background-color: #e64944;
                border-radius: 25px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                color: #fff;
                cursor: pointer;
                display: -webkit-box;
                display: -webkit-flex;
                display: -moz-box;
                display: flex;
                font-size: 1.5em;
                font-weight: 500;
                height: 50px;
                -webkit-justify-content: center;
                justify-content: center;
                letter-spacing: 1px;
                min-width: 130px;
                padding: 5px 15px;
                text-decoration: none;
                -webkit-transition: -webkit-transform .15s ease;
                transition: -webkit-transform .15s ease;
                -moz-transition: transform .15s ease, -moz-transform .15s ease;
                transition: transform .15s ease;
                transition: transform .15s ease, -webkit-transform .15s ease, -moz-transform .15s ease;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .play-button-disabled {
                -webkit-animation: none;
                -moz-animation: none;
                animation: none;
                background: #e64944 url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMjAiIGhlaWdodD0iMzAiIGZpbGw9IiNmZmYiPjxjaXJjbGUgY3g9IjE1IiBjeT0iMTUiIHI9IjE1Ij48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJyIiBiZWdpbj0iMHMiIGNhbGNNb2RlPSJsaW5lYXIiIGR1cj0iMC44cyIgZnJvbT0iMTUiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiB0bz0iMTUiIHZhbHVlcz0iMTU7OTsxNSIvPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImZpbGwtb3BhY2l0eSIgYmVnaW49IjBzIiBjYWxjTW9kZT0ibGluZWFyIiBkdXI9IjAuOHMiIGZyb209IjEiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiB0bz0iMSIgdmFsdWVzPSIxOy41OzEiLz48L2NpcmNsZT48Y2lyY2xlIGN4PSI2MCIgY3k9IjE1IiByPSI5IiBmaWxsLW9wYWNpdHk9Ii4zIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJyIiBiZWdpbj0iMHMiIGNhbGNNb2RlPSJsaW5lYXIiIGR1cj0iMC44cyIgZnJvbT0iOSIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIHRvPSI5IiB2YWx1ZXM9Ijk7MTU7OSIvPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImZpbGwtb3BhY2l0eSIgYmVnaW49IjBzIiBjYWxjTW9kZT0ibGluZWFyIiBkdXI9IjAuOHMiIGZyb209Ii41IiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSIgdG89Ii41IiB2YWx1ZXM9Ii41OzE7LjUiLz48L2NpcmNsZT48Y2lyY2xlIGN4PSIxMDUiIGN5PSIxNSIgcj0iMTUiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9InIiIGJlZ2luPSIwcyIgY2FsY01vZGU9ImxpbmVhciIgZHVyPSIwLjhzIiBmcm9tPSIxNSIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIHRvPSIxNSIgdmFsdWVzPSIxNTs5OzE1Ii8+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iZmlsbC1vcGFjaXR5IiBiZWdpbj0iMHMiIGNhbGNNb2RlPSJsaW5lYXIiIGR1cj0iMC44cyIgZnJvbT0iMSIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIHRvPSIxIiB2YWx1ZXM9IjE7LjU7MSIvPjwvY2lyY2xlPjwvc3ZnPg==) no-repeat 50%;
                background-size: 50%;
                color: transparent;
                cursor: default;
            }

            .play-button:link,
            .play-button:visited {
                cursor: pointer;
            }

            .play-button:active,
            .play-button:hover {
                color: #fff;
                -webkit-transform: scale(1.2);
                -moz-transform: scale(1.2);
                -ms-transform: scale(1.2);
                transform: scale(1.2);
            }

            .play-button>.icon {
                background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NzkuODYyIDQ3OS44NjIiPjxwYXRoIGZpbGw9IiNmZmYiIGQ9Ik0zNTkuODYyIDE1MS4wNDdjLTE3LjY3MyAwLTMyIDE0LjMyNy0zMiAzMnMxNC4zMjcgMzIgMzIgMzJjMTcuNjczIDAgMzItMTQuMzI3IDMyLTMycy0xNC4zMjctMzItMzItMzJ6bTAgNDhjLTguODM3IDAtMTYtNy4xNjMtMTYtMTZzNy4xNjMtMTYgMTYtMTYgMTYgNy4xNjMgMTYgMTYtNy4xNjQgMTYtMTYgMTZ6bTAgNjRjLTE3LjY3MyAwLTMyIDE0LjMyNy0zMiAzMiAwIDE3LjY3MyAxNC4zMjcgMzIgMzIgMzIgMTcuNjczIDAgMzItMTQuMzI3IDMyLTMyIDAtMTcuNjczLTE0LjMyNy0zMi0zMi0zMnptMCA0OGMtOC44MzcgMC0xNi03LjE2My0xNi0xNnM3LjE2My0xNiAxNi0xNiAxNiA3LjE2MyAxNiAxNi03LjE2NCAxNi0xNiAxNnptLTU2LTEwNGMtMTcuNjczIDAtMzIgMTQuMzI3LTMyIDMyczE0LjMyNyAzMiAzMiAzMmMxNy42NzMgMCAzMi0xNC4zMjcgMzItMzJzLTE0LjMyNy0zMi0zMi0zMnptMCA0OGMtOC44MzcgMC0xNi03LjE2My0xNi0xNnM3LjE2My0xNiAxNi0xNiAxNiA3LjE2MyAxNiAxNi03LjE2NCAxNi0xNiAxNnptMTEyLTQ4Yy0xNy42NzMgMC0zMiAxNC4zMjctMzIgMzJzMTQuMzI3IDMyIDMyIDMyYzE3LjY3MyAwIDMyLTE0LjMyNyAzMi0zMnMtMTQuMzI3LTMyLTMyLTMyem0wIDQ4Yy04LjgzNyAwLTE2LTcuMTYzLTE2LTE2czcuMTYzLTE2IDE2LTE2IDE2IDcuMTYzIDE2IDE2LTcuMTY0IDE2LTE2IDE2em0tMjMyLTQ4aC0zMnYtMzJhOCA4IDAgMCAwLTgtOGgtNDhhOCA4IDAgMCAwLTggOHYzMmgtMzJhOCA4IDAgMCAwLTggOHY0OGE4IDggMCAwIDAgOCA4aDMydjMyYTggOCAwIDAgMCA4IDhoNDhhOCA4IDAgMCAwIDgtOHYtMzJoMzJhOCA4IDAgMCAwIDgtOHYtNDhhOCA4IDAgMCAwLTgtOHptLTggNDhoLTMyYTggOCAwIDAgMC04IDh2MzJoLTMydi0zMmE4IDggMCAwIDAtOC04aC0zMnYtMzJoMzJhOCA4IDAgMCAwIDgtOHYtMzJoMzJ2MzJhOCA4IDAgMCAwIDggOGgzMnYzMnoiLz48cGF0aCBmaWxsPSIjZmZmIiBkPSJNMzYwLjgzIDExOS4xMDNhNy44MjEgNy44MjEgMCAwIDAtLjk2OC0uMDU2aC0yNDBhNy41MDcgNy41MDcgMCAwIDAtLjk2LjA1NkM1Mi4xNTkgMTIwLjE4Ny0xLjA2OCAxNzUuMTcxLjAxNiAyNDEuOTEzYzEuMDcxIDY1LjkzIDU0Ljc4NyAxMTguODM1IDEyMC43MjYgMTE4LjkwMmExMTkuODg4IDExOS44ODggMCAwIDAgODMuNzYtMzMuNzY4aDcwLjcyYzQ4LjA5NCA0Ni4yNzcgMTI0LjU5NiA0NC44MDQgMTcwLjg3My0zLjI4OWExMjAuODUgMTIwLjg1IDAgMCAwIDMzLjc2Ny04My44MzFjLS4xOTQtNjUuOTUzLTUzLjA4OS0xMTkuNjQ1LTExOS4wMzItMTIwLjgyNHptLTEuODQgMjI1LjcyLS4wMDgtLjAwOGExMDQuMTEzIDEwNC4xMTMgMCAwIDEtNzQuNzY4LTMxLjM2OCA4IDggMCAwIDAtNS42OTYtMi40aC03Ny4zMTJhOCA4IDAgMCAwLTUuNjk2IDIuNGMtNDAuNTg4IDQxLjMwNy0xMDYuOTc3IDQxLjg4OS0xNDguMjgzIDEuMzAxUzUuMzM4IDIwNy43NzEgNDUuOTI2IDE2Ni40NjVhMTA0Ljg1MyAxMDQuODUzIDAgMCAxIDc0LTMxLjM2MmMuMjY3IDAgLjUzNS0uMDE2LjgtLjA0OEgzNTguOTljLjI2Ni4wMzIuNTMzLjA0OC44LjA0OCA1Ny45MTEuNjc2IDEwNC4zMDkgNDguMTcgMTAzLjYzMyAxMDYuMDgtLjY2OCA1Ny4yNjktNDcuMTYxIDEwMy40MDgtMTA0LjQzMyAxMDMuNjR6Ii8+PC9zdmc+);
                height: 32px;
                margin-right: 10px;
                width: 32px;
            }

            .play-button>.title {
                line-height: 1.5em;
                text-align: center;
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
        <div id="preloading-game" class="gameframe-content">
            <div class="game-item">
                <div class="image">
                    <img width="100" height="75" class="logo" src="<?php echo \helper\image::get_thumbnail($game->image, 100, 75, "m"); ?>" title="<?php echo $game_name; ?>" alt="<?php echo $game_name; ?> img" />
                </div>
            </div>
            <h1 class="game-title"><?php echo $game_name; ?></h1>
            <div class="game-play">
                <div id="btn_loader" class="play-button-disabled" title="loader"></div>
                <a id="btn_play" style="display: none;" class="play-button" href="javascript:" onclick="<?php echo ($game->type == 'EXTERNAL') ? 'openInNewWindow()' : 'start_game_frame()' ?>"
                    title="<?php echo $game_name; ?>"><span class="icon"></span><span class="title">Play</span></a>
            </div>

        </div>

        <script>
            let game_type = "<?php echo $game_type ?>";
            let url_game = "<?php echo $game->source_html ?>";
            let check_load_now = "<?php echo $check_load_now ?>";
            let check_referrer = "<?php echo $check_referrer ?>";

            setTimeout(() => {
                if (document.getElementById("btn_loader")) {
                    document.getElementById("btn_loader").remove();
                    document.getElementById("btn_play").style.display = 'flex';
                }
            }, 630); // 1000 == (1s)

            document.addEventListener('DOMContentLoaded', function() {
                if (game_type != 'EXTERNAL' && check_load_now) {
                    start_game_frame();
                } else {
                    if (game_type == 'IFRAME_HTML') {
                        setTimeout(() => {
                            start_game_frame();
                        }, 630); // 1000 convert (s)
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
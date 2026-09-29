</div>
</div>
</div>

<?php $theme_url = '/' . DIR_THEME; ?>

<div class="layout__footer">
    <footer class="footer">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__copyright"><strong>Disclaimer: </strong> <a style="color:#fff" title="<?php echo \helper\options::options_by_key_type('site_name') ?>" href="/"> <?php echo \helper\options::options_by_key_type('site_name') ?> </a> is an independent website and is not affiliated with any organizations.</div>
                <div class="footer__menu">
                    <nav class="footer-menu">
                        <ul id="menu-footer" class="footer-menu__inner">
                            <li id="menu-item-1454" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1454">
                                <a href="/about-us" title="About Us">About Us</a>
                            </li>
                            <li id="menu-item-1452" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1452">
                                <a href="/contact-us" title="Contact Us">Contact Us</a>
                            </li>
                            <li id="menu-item-1435" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-1435">
                                <a href="/term-of-use" title="Term Of Use">Term Of Use</a>
                            </li>
                            <li id="menu-item-1455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1455">
                                <a href="/privacy-policy" title="Privacy Policy">Privacy Policy</a>
                            </li>
                            <li id="menu-item-1453" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1453">
                                <a href="/copyright-infringement-notice-procedure" title="Copyright">Copyright Infringement Notice Procedure</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>

<a id="back-to-top" href="#" title="Наверх" class="btn-top">
    <svg class="icon" width="18px" height="18px">
        <use xlink:href="#icon-arrow-right"></use>
    </svg>
</a>

<div class="loading_mask hidden-load">
    <svg width="80px" height="80px" viewBox="0 0 100 100">
        <g transform="translate(50 50)">
            <g transform="scale(0.794652 0.794652)">
                <animateTransform attributeName="transform" type="scale" calcMode="spline" values="0.8;0.5;0.8" keyTimes="0;0.5;1" dur="1.5s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" begin="0s" repeatCount="indefinite"></animateTransform>
                <rect x="-45" y="-45" width="90" height="90" fill="#ffffcb" stroke="#ff7c81" stroke-width="8" rx="5.55556" transform="rotate(4.81284)">
                    <animate attributeName="rx" calcMode="linear" values="0;50;0" keyTimes="0;0.5;1" dur="1.5" begin="0s" repeatCount="indefinite"></animate>
                    <animate attributeName="stroke-width" calcMode="linear" values="8;24;8" keyTimes="0;0.5;1" dur="1.5" begin="0s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 0 0;270 0 0;540 0 0" keyTimes="0;0.5;1" dur="1.5s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" begin="0s" repeatCount="indefinite"></animateTransform>
                </rect>
            </g>
        </g>
    </svg>
</div>

<!-- all <svg> header_game: share +comment + fullscreen ...-->
<div class="images-preload">
    <svg>
        <symbol id="icon-close" viewBox="0 0 512 512">
            <path d="M293.264 256.358L503.689 47.0834C506.085 44.7262 507.988 41.9156 509.287 38.8155C510.586 35.7154 511.255 32.3877 511.255 29.0264C511.255 25.6651 510.586 22.3374 509.287 19.2373C507.988 16.1372 506.085 13.3266 503.689 10.9694C493.626 0.982956 477.281 0.982956 467.218 10.9694L256.973 220.065L44.7842 7.8529C34.7213 -2.23547 18.3765 -2.23547 8.31357 7.8529C-1.74933 17.9668 -1.74933 34.337 8.31357 44.4254L220.348 256.485L7.54718 468.11C-2.51573 478.096 -2.51573 494.263 7.54718 504.224C17.6101 514.21 33.9549 514.21 44.0178 504.224L256.638 292.777L467.982 504.147C478.045 514.235 494.39 514.235 504.453 504.147C514.516 494.033 514.516 477.663 504.453 467.575L293.264 256.358Z" />
        </symbol>
        <symbol id="icon-search" viewBox="0 0 56.966 56.966">
            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
        s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
        c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
        s-17-7.626-17-17S14.61,6,23.984,6z" />
        </symbol>
        <symbol id="icon-arrow-right" viewBox="0 0 451.846 451.847">
            <path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z" />
        </symbol>
        <symbol id="icon-fullscreen" viewBox="0 0 64 64">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0878 32V12.0878H32V6H6V32H12.0878Z" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M32 58H58V32H51.9122V51.9122H32V58Z" />
            <path d="M18.3531 22.6654L22.6653 18.3532L45.6214 41.3093L41.3093 45.6215L18.3531 22.6654Z" />
        </symbol>
        <symbol id="icon-share" viewBox="0 0 512.231 512.231">
            <path d="m271.249 121.448c-70.515 3.65-136.443 33.004-187.025 83.587-54.152 54.151-83.975 125.899-83.975 202.025v105.171l38.098-87.825c44.499-88.669 134.739-147.458 232.902-152.927v121.202l240.733-196.638-240.733-196.043zm30 29.612v-87.94l163.267 132.958-163.267 133.361v-88.379h-15c-56.878 0-112.732 15.993-161.522 46.249-36.948 22.913-68.428 53.121-92.593 88.604 15.408-126.529 123.493-224.853 254.115-224.853z" />
        </symbol>
        <symbol id="icon-menu" viewBox="0 0 64 64">
            <path d="M45.4125 32C45.4125 30.575 44.25 29.4125 42.825 29.4125H2.575C1.1625 29.4125 0 30.575 0 32C0 33.425 1.1625 34.5875 2.5875 34.5875H42.8375C44.2625 34.5875 45.4125 33.425 45.4125 32Z" />
            <path d="M61.4125 9.79999H2.5875C1.1625 9.79999 0 10.9625 0 12.3875C0 13.8125 1.1625 14.975 2.5875 14.975H61.4125C62.8375 14.975 64 13.8125 64 12.3875C64 10.9625 62.8375 9.79999 61.4125 9.79999Z" />
            <path d="M61.4125 49.025H2.5875C1.1625 49.025 0 50.1875 0 51.6125C0 53.0375 1.1625 54.2 2.5875 54.2H61.4125C62.8375 54.2 64 53.0375 64 51.6125C64 50.1875 62.8375 49.025 61.4125 49.025Z" />
        </symbol>
        <symbol id="icon-comments" viewBox="0 0 512 512">
            <path d="M160 176C151.513 176 143.374 179.371 137.373 185.373C131.371 191.374 128 199.513 128 208C128 216.487 131.371 224.626 137.373 230.627C143.374 236.629 151.513 240 160 240C168.487 240 176.626 236.629 182.627 230.627C188.629 224.626 192 216.487 192 208C192 199.513 188.629 191.374 182.627 185.373C176.626 179.371 168.487 176 160 176ZM224 208C224 199.513 227.371 191.374 233.373 185.373C239.374 179.371 247.513 176 256 176C264.487 176 272.626 179.371 278.627 185.373C284.629 191.374 288 199.513 288 208C288 216.487 284.629 224.626 278.627 230.627C272.626 236.629 264.487 240 256 240C247.513 240 239.374 236.629 233.373 230.627C227.371 224.626 224 216.487 224 208ZM352 176C343.513 176 335.374 179.371 329.373 185.373C323.371 191.374 320 199.513 320 208C320 216.487 323.371 224.626 329.373 230.627C335.374 236.629 343.513 240 352 240C360.487 240 368.626 236.629 374.627 230.627C380.629 224.626 384 216.487 384 208C384 199.513 380.629 191.374 374.627 185.373C368.626 179.371 360.487 176 352 176Z" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M80 16C58.7827 16 38.4344 24.4285 23.4315 39.4315C8.42855 54.4344 0 74.7827 0 96L0 320C0 341.217 8.42855 361.566 23.4315 376.569C38.4344 391.571 58.7827 400 80 400H80.192L80.352 474.848C80.3576 478.045 81.3208 481.167 83.1175 483.812C84.9141 486.456 87.4618 488.502 90.432 489.685C93.4022 490.867 96.6586 491.133 99.7814 490.448C102.904 489.763 105.75 488.158 107.952 485.84L189.376 400H432C453.217 400 473.566 391.571 488.569 376.569C503.571 361.566 512 341.217 512 320V96C512 85.4943 509.931 75.0914 505.91 65.3853C501.89 55.6793 495.997 46.8601 488.569 39.4315C481.14 32.0028 472.321 26.11 462.615 22.0896C452.909 18.0693 442.506 16 432 16H80ZM32 96C32 83.2696 37.0571 71.0606 46.0589 62.0589C55.0606 53.0571 67.2696 48 80 48H432C444.73 48 456.939 53.0571 465.941 62.0589C474.943 71.0606 480 83.2696 480 96V320C480 332.73 474.943 344.939 465.941 353.941C456.939 362.943 444.73 368 432 368H182.496C180.322 367.999 178.171 368.442 176.174 369.3C174.177 370.158 172.376 371.414 170.88 372.992L112.256 434.784L112.16 383.968C112.152 379.73 110.462 375.669 107.462 372.675C104.463 369.681 100.398 368 96.16 368H80C67.2696 368 55.0606 362.943 46.0589 353.941C37.0571 344.939 32 332.73 32 320V96Z">
        </symbol>
    </svg>
</div>

<link rel="stylesheet" id="share-css" href="https://cdn.ampproject.org/v0/bento-social-share-1.0.css?ver=1698139581953" type="text/css" media="all" />

<script type="text/javascript" src="<?php echo $theme_url; ?>rs/js/jquery-3.4.1.min.js"></script>
<script src="<?php echo $theme_url ?>rs/js/app.js"></script>
<script defer src="<?php echo $theme_url; ?>rs/js/jquery.validate.min.js"></script>
<script defer src="<?php echo $theme_url; ?>rs/plugins/raty/jquery.raty.js"></script>
<script src="<?php echo $theme_url; ?>rs/js/script.js"></script>
</body>

</html>
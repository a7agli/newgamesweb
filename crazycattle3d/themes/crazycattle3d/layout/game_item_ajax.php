<?php
foreach ($games as $item) {
    $arr_games_views[] = $item->views;
}
//sắp xếp lại Mảng theo thứ tự views giảm dần
rsort($arr_games_views);
//lấy ra các đk view để so sánh
foreach ($arr_games_views as $k => $n) {
    if ($k < 5) {
        if ($k == 0) {
            $max_views = $n;
        } elseif ($k == 3) {
            $views_4 = $n;
        }
    }
}
// cần thêm lần if trong if đầu tiên để tránh ko bị sót game theo điều kiện if($x < 5) kia
?>

<div class="g-items card-masonry">
    <?php
    $x = 0;
    foreach ($games as $k2 => $item) :
        if ($item->views >= $views_4 && $item->views <= $max_views &&  $flag && $k2 < 15) :
            $x += 1;
            if ($x < 3) :
    ?>
                <div class="g-items__item_large item large">
                    <div class="g-item g-item--small g-item--dark">
                        <div class="g-item__inner">
                            <div class="g-item__overlay">
                                <a class="g-item__title" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>"><?php echo $item->name; ?></a>
                            </div>
                            <a class="g-item__thumb" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>">
                                <img width="300" height="300" src="<?php echo '/' . DIR_THEME ?>rs/imgs/game_load.webp" data-src="<?php echo \helper\image::get_thumbnail($item->image, 300, 300, 'm'); ?>" class="lazy-image g-item__thumb wp-post-image" decoding="async" loading="lazy" sizes="(max-width: 300px) 100vw, 300px" title="<?php echo $item->name; ?>" alt="<?php echo $item->name; ?> img" />
                            </a>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="g-items__item item">
                    <div class="g-item g-item--small g-item--dark">
                        <div class="g-item__inner">
                            <div class="g-item__overlay">
                                <a class="g-item__title" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>"><?php echo $item->name; ?></a>
                            </div>
                            <a class="g-item__thumb" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>">
                                <img width="300" height="300" src="<?php echo '/' . DIR_THEME ?>rs/imgs/game_load.webp" data-src="<?php echo \helper\image::get_thumbnail($item->image, 300, 300, 'm'); ?>" class="lazy-image g-item__thumb wp-post-image" decoding="async" loading="lazy" sizes="(max-width: 300px) 100vw, 300px" title="<?php echo $item->name; ?>" alt="<?php echo $item->name; ?> img" />
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php else : ?>
            <div class="g-items__item item">
                <div class="g-item g-item--small g-item--dark">
                    <div class="g-item__inner">
                        <div class="g-item__overlay">
                            <a class="g-item__title" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>"><?php echo $item->name; ?></a>
                        </div>
                        <a class="g-item__thumb" href="/<?php echo $item->slug; ?>" title="<?php echo $item->name; ?>">
                            <img width="300" height="300" src="<?php echo '/' . DIR_THEME ?>rs/imgs/game_load.webp" data-src="<?php echo \helper\image::get_thumbnail($item->image, 300, 300, 'm'); ?>" class="lazy-image g-item__thumb wp-post-image" decoding="async" loading="lazy" sizes="(max-width: 300px) 100vw, 300px" title="<?php echo $item->name; ?>" alt="<?php echo $item->name; ?> img" />
                        </a>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</div>

<?php if ($paging_content) {
    echo \helper\themes::get_layout('pagination', array('paging_content' => $paging_content));
}
?>
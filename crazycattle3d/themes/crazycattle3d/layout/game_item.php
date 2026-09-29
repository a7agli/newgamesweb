<?php
if (!$limit) {
    $limit = \helper\options::options_by_key_type('game_home_limit', 'display');
    if (!$limit) {
        $limit = 50;
    }
}
if (!$page) {
    $page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
}
if (!$field_order) {
    $field_order = \helper\options::options_by_key_type('field_order', 'display') ? \helper\options::options_by_key_type('field_order', 'display') : "publish_date";
}
$display = "yes";
$order_type = "DESC";
$num_link = 3;

if ($tag_id != '') {
    $games = \helper\game::paging_by_tag($tag_id, $page, $limit);
    $count = \helper\game::count_by_tag($tag_id);
    $paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);
} else {
    if ($trending) {
        $games = \helper\game::get_top($top, $page, $limit3, $type);
        $count = $limit;
    } else {
        $games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
        $count = \helper\game::get_count($keywords, $type, $display, $is_hot, $is_new, $category_id, $not_equal);
    }
    $paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);
}

?>

<div class="template__content">
    <?php if ($enable_ads) : ?>
        <div class="ads-slot ">
            <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
        </div><br>
    <?php endif ?>

    <?php
    if (!count($games)) {
        echo \helper\themes::get_layout('error', array('keywords' => $keywords));

        if ($enable_ads) {
            $ads = \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads));
            echo '<br><div class="ads-slot ">';
            echo "$ads";
            echo '</div>';
        }
    } else {
    ?>
        <section class="area">
            <div class="area__heading">
                <?php if ($is_home) : ?>
                    <h1 class="area__title title">All games</h1>
                <?php else : ?>
                    <h1 class="area__title title"><?php echo ($title) ?></h1>
                <?php endif; ?>
            </div>

            <div class="" id="ajax-append">
                <?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games, 'paging_content' => $paging_content, 'flag' => true)); ?>
            </div>

            <?php if ($enable_ads) : ?>
                <br>
                <div class="ads-slot ">
                    <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                </div>
            <?php endif ?>

            <?php if ($post || $slogan) : ?>
                <section class="area">
                    <div class="area__columns">
                        <div class="area__column area__column--content content">
                            <div class="game__content">
                                <?php if ($post) : ?>
                                    <h2 class="title-option"><?php echo $post->title; ?></h2>
                                    <?php if ($post->content) : ?>
                                        <div><?php echo html_entity_decode($post->content); ?></div>
                                    <?php else : ?>
                                        <div><?php echo html_entity_decode($post->excerpt); ?></div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <h2 class="title-option"><?php echo $title; ?></h2>
                                    <div><?php echo html_entity_decode($slogan); ?></div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </section>
    <?php } ?>
</div>

<script>
    keywords = "<?php echo $keywords; ?>";
    field_order = "<?php echo $field_order ?>";
    order_type = "<?php echo $order_type ?>";
    category_id = "<?php echo $category_id ?>";
    is_hot = "<?php echo $is_hot ?>";
    is_new = "<?php echo $is_new ?>";
    tag_id = "<?php echo $tag_id ?>";
    limit = "<?php echo $limit ?>";
</script>
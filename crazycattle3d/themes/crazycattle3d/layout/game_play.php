<?php
if (!$limit) {
	$limit = \helper\options::options_by_key_type('game_related_limit', 'display');
	if (!$limit) {
		$limit = 24;
	}
}
$page = 1;
$order_type = "DESC";
$display = "yes";
$field_order = "views";
$not_equal['slug'] = $game->slug;
//comment
$url = load_url()->current_url();

$list_cate = \helper\game::find_related_category($game->id);
$list_tags = \helper\game::find_related_tag($game->id);
if (count($list_cate)) {
	$arr_bread = array(
		array(
			'name' => $list_cate[0]->name,
			'slug' => $list_cate[0]->slug,
			'source' => 'games/' . $list_cate[0]->slug,
		),
		array(
			'name' => $game->name,
		),
	);

	$category_id = $list_cate[0]->id;
} elseif (count($list_tags)) {
	$arr_bread = array(
		array(
			'name' => $list_tags[0]->name,
			'slug' => $list_tags[0]->slug,
			'source' => 'tag/' . $list_tags[0]->slug,
		),
		array(
			'name' => $game->name,
		),
	);
} else {
	$arr_bread = array(
		array(
			'name' => $game->name,
		)
	);
}

if ($category_id) {
	foreach ($list_cate as $cate_id) {
		$g = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $cate_id->id, $not_equal);
		foreach ($g as $g1) {
			$g2[] = $g1;
		}
	}
	$games_category2 = \helper\game::remove_duplicate_game($g2);
	$games_category2 = array_values($games_category2);
	$games_category = [];
	foreach ($games_category2 as $k => $item_cate) {
		if ($k < $limit) {
			$games_category[] = $item_cate;
		}
	}
} else {
	$games_category = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, NULL, $not_equal);
}

$limit_cate = \helper\options::options_by_key_type('game_category_limit', 'display');
if (!$limit_cate) {
	$limit_cate = 12;
}
$field_order2 = "publish_date";
$games_news = \helper\game::get_paging($page, $limit_cate, $keywords, $type, $display, $is_hot, $is_new, $field_order2, $order_type, NULL, $not_equal);

\helper\game::update_views($game->id);

$credit = false;
$text = '';
if (strpos($game->source_html, 'scratch.mit.edu') || strpos('scratch.mit.edu', $game->source_html)) {
	$credit = true;
	$text = '<p>Created by <a target="_blank" rel="nofollow" href="https://scratch.mit.edu/users/griffpatch/">griffpatch<a/> , <a target="_blank" rel="nofollow" href="https://scratch.mit.edu/users/iPhone_ATT_TWC115/">iPhone_ATT_TWC115</a>and the Scratch community</p>';
}

?>

<div class="template__content">
	<section class="area area--pattern">
		<div class="player">

			<?php if ($enable_ads) : ?>
				<div class="ads-slot ">
					<?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
				</div>
				<br>
			<?php endif ?>

			<div class="player__inner">
				<div class="player__columns">
					<div class="player__content">
						<div id="flash-container" class="flash-container iframe" data-fullwidth="0">
							<iframe class="iframe-default" id="iframehtml5" title="<?php echo $game->name; ?>" width="100%" height="<?php echo ($game->height > 600) ? $game->height : 600 ?>px" src="/<?= $game->slug ?>.embed" frameborder="0" border="0" scrolling="auto" allowfullscreen></iframe>
						</div>
						<div class="player__actions player-actions">
							<div class="player-actions__item">
								<div class="shares-popup">
									<a href="#" class="btn btn--accent shares-popup__toggler player-action player-action--shares js-shares-toggler" title="Share">
										<svg class="icon" width="24px" height="24px">
											<use xlink:href="#icon-share"></use>
										</svg>
										Share
									</a>
									<div class="shares-popup__form js-shares-popup">
										<div class="shares-popup__inner">
											<p class="shares-popup__title">Share with friends:</p>
											<a href="#" class="shares-popup__close js-shares-popup-close" title="Close Share">
												<svg class="icon" width="20px" height="20px">
													<use xlink:href="#icon-close"></use>
												</svg>
											</a>
											<div class="shares">
												<div class="shares__buttons">
													<div class="social-share-group">
														<bento-social-share type="email" aria-label="Share via email"></bento-social-share>
														<bento-social-share type="facebook" aria-label="Share on Facebook"></bento-social-share>
														<bento-social-share type="twitter" aria-label="Share on Twitter"></bento-social-share>
														<bento-social-share type="linkedin" aria-label="Share on Linkedin"></bento-social-share>
														<bento-social-share type="pinterest" aria-label="Share on pinterest"></bento-social-share>
														<bento-social-share type="tumblr" aria-label="Share on tumblr"></bento-social-share>
														<bento-social-share type="whatsapp" aria-label="Share on whatsapp"></bento-social-share>
														<bento-social-share type="line" aria-label="Share on line"></bento-social-share>
													</div>
												</div>
												<p class="shares__subtitle">Or share link</p>
												<div class="shares__link">
													<input id="shares-link-input" class="shares__link-val" value="<?PHP echo $url ?>" />
													<a href="#" class="shares__link-copy js-shares-copy-link" title="Copy share link">Copy</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="player-actions__item">
								<a href="#comments" class="btn btn--accent" title="Comment">
									<svg class="icon" width="24px" height="24px">
										<use xlink:href="#icon-comments"></use>
									</svg>
									Comment </a>
							</div>
							<div class="player-actions__item">
								<a href="#" class="btn-fullscreen js-fullscreen" title="fullscreen">
									<svg class="icon" width="24px" height="24px">
										<use xlink:href="#icon-fullscreen"></use>
									</svg>
								</a>
							</div>
						</div>

					</div>
				</div>
			</div>
			<?php if ($credit) : ?>
				<div style="text-align: center;padding: 10px 0;background: #ffd2d2;border-radius: 15px;margin-top: 10px;">
					<p>Created by <a target="_blank" rel="nofollow" href="https://scratch.mit.edu/users/griffpatch/">griffpatch</a>, <a target="_blank" rel="nofollow" href="https://scratch.mit.edu/users/iPhone_ATT_TWC115/">iPhone_ATT_TWC115</a> and the Scratch community</p>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($enable_ads) : ?>
			<div class="ads-slot ">
				<?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
			</div>
			<br>
		<?php endif ?>

		<div class="player__header player-header">
			<img width="300" height="300" src="<?php echo '/' . DIR_THEME ?>rs/imgs/game_load.webp" data-src="<?php echo \helper\image::get_thumbnail($game->image, 300, 300, "m"); ?>" class="lazy-image player-header__thumb img-fluid wp-post-image" decoding="async" fetchpriority="high" sizes="(max-width: 300px) 100vw, 300px" alt="<?php echo $game->name; ?>" title="<?php echo $game->name; ?>" />
			<div class="player-header__content">
				<h1 class="player-header__title title"><?php echo $game->name ?></h1>
				<div class="player-header__rating">
					<div class="rating-box">
						<div id="append-rate"></div>

					</div>
				</div>
				<?php if (count($list_cate) || count($list_tags)) : ?>
					<div class="player-header__categories">
						<section class="tags">
							<div class="tags__items">
								<?php foreach ($list_cate as $cate) : ?>
									<div class="tags__item tag">
										<a class="tag__link" href="/games/<?php echo $cate->slug; ?>" title="<?php echo $cate->name; ?>">
											<span class="tag__title"><?php echo $cate->name; ?></span>
										</a>
									</div>
								<?php endforeach; ?>

								<?php foreach ($list_tags as $tag) : ?>
									<div class="tags__item tag">
										<a class="tag__link" href="/tag/<?php echo $tag->slug; ?>" title="<?php echo $tag->name; ?>">
											<span class="tag__title"><?php echo $tag->name; ?></span>
										</a>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<br>

		<?php if ($games_category) : ?>
			<section id="hot" class="games games--hot">
				<div class="games__inner">
					<div class="area__heading">
						<p class="area__title title">Play <b>other games</b></p>
					</div>
					<div class="">
						<?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games_category, 'flag' => true)); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
	</section>
	<section class="area">
		<div class="area__columns">
			<div class="area__column area__column--content content">

				<?php echo \helper\themes::get_layout('bread_crumb', array('arr_bread' => $arr_bread, 'title' => $game->name)); ?>
				<br>

				<div class="game__content <?php echo $is_home ? '' : 'desc-text' ?>">
					<?php if ($game->content) : ?>
						<?php echo html_entity_decode($game->content); ?>
					<?php else : ?>
						<p><?php echo $game->excerpt; ?></p>
					<?php endif; ?>
					<?php if ($game->controlsguide) : ?>
						<h2 class="title-option">Instructions</h2>
						<?php echo html_entity_decode($game->controlsguide); ?>
					<?php endif; ?>
				</div>
				<?php if (!$is_home) : ?>
					<div class="showmore mt-3">
						<p class="btn-showmore" href="javascript:void(0)" title="Show more / Show less">Show more »</p>
					</div>
				<?php endif; ?>
			</div>

			<div class="area__column area__column--side">
				<div id="comments" class="comments">
					<h2 class="comment-title">Discuss: <?php echo $game->name ?></h2>
					<div id="append-comment"></div>
				</div>
			</div>
		</div>
	</section>

	<section class="area">
		<div class="area__heading">
			<p class="area__title title">
				All free games <b>for you</b> </p>
			<div class="area-heading__meta">
				<a href="/new-games" class="area-heading__button btn btn--accent" title="View all">View all</a>
			</div>
		</div>
		<div class="">
			<?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games_news, 'flag' => true)); ?>
		</div>
	</section>
</div>

<script>
	id_game = "<?php echo $game->id; ?>";
	url_game = "<?php echo $url; ?>";
</script>
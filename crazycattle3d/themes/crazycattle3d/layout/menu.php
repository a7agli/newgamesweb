<?php
$logo = \helper\options::options_by_key_type('logo');
$title = \helper\options::options_by_key_type('site_name');
$menu_header = \helper\menu::find_menu_by_menugroup('menu_header');
// in($menu_header);
// $menu_header = \helper\menu::to_menu_directory_style($menu_header);
// $list_tags = \helper\tag::find_tag_by_taxonomy('game');
?>

<div class="layout">
	<div class="layout__header">
		<header class="header" role="banner">
			<div class="container">
				<div class="header__inner">
					<div class="header__logo">
						<a href="/" class="logo" title="<?php echo $title ?>">
							<img class="img-fluid logo__image logo__image--dark" src="<?php echo \helper\image::get_thumbnail($logo, '', 60, 'h') ?>" width="100%" height="60" title="<?php echo $title ?>" alt="<?php echo $title ?> logo" />
							<img class="img-fluid logo__image logo__image--light" src="<?php echo \helper\image::get_thumbnail($logo, '', 60, 'h') ?>" width="100%" height="60" title="<?php echo $title ?>" alt="<?php echo $title ?> logo" />
						</a>
					</div>
					<div class="header__search">
						<div class="search-form">
							<div class="search-form__inner">
								<input id="search" class="search-form__input" value="<?php echo $keywords ?>" placeholder="Search games" type="text" />
								<button class="search-form__btn search-form-send--js" aria-label="search">
									<svg class="icon" width="20px" height="20px">
										<use xlink:href="#icon-search"></use>
									</svg>
								</button>
							</div>
						</div>
					</div>
					<div class="header__mobile">
						<a href="#" class="nav-side-toggler js-nav-side-toggle" title="Button Menu">
							<svg class="icon" width="40px" height="40px">
								<use xlink:href="#icon-menu"></use>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</header>
	</div>

	<div class="layout__content">
		<div class="container">
			<div class="template">

				<!-- sidebar -->
				<div class="template__sidebar">
					<nav class="nav-side js-nav-side">
						<div class="nav-side__widget">
							<nav class="side-menu">
								<ul id="menu-side-menu" class="side-menu__inner">
									<li id="menu-item-1440" class="menu-item menu-item-type-taxonomy menu-item-object-category side-menu__item side-menu__item--1440">
										<a href="/new-games" class="side-menu__link side-menu__link--1440" title="New Games">
											<span class="name">New Games</span>
										</a>
									</li>
									<li id="menu-item-1468" class="menu-item menu-item-type-taxonomy menu-item-object-category side-menu__item side-menu__item--1468">
										<a href="/hot-games" class="side-menu__link side-menu__link--1468" title="Hot Games">
											<span class="name">Hot Games</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="nav-side__widget">
							<ul class="theme-toggler">
								<li class="theme-toggler__item">
									<a id="light-button" href="#" class="theme-toggler__button js-theme-toggler active" title="Button Light">Light</a>
								</li>
								<li class="theme-toggler__item">
									<a id="dark-button" href="#" class="theme-toggler__button js-theme-toggler" title="Button Dark">Dark</a>
								</li>
							</ul>
						</div>

						<ul class="nav-side__items">
							<?php foreach ($menu_header as $k => $menu) : ?>
								<li class="nav-side__item">
									<a href="<?php echo $menu->url; ?>" class="nav-side__link" title="<?php echo $menu->title; ?>">
										<?php if ($menu->img) : ?>
											<img width="39" height="39" src="<?php echo '/' . DIR_THEME ?>rs/imgs/game_load.webp" data-src="<?php echo \helper\image::get_thumbnail($menu->img, 39, 39, 'm') ?>" class="lazy-image img-fluid nav-side__icon wp-post-image" decoding="async" loading="lazy" sizes="(max-width: 39px) 100vw, 39px" title="<?php echo $menu->title; ?>" alt="<?php echo $menu->title ?> img" />
										<?php endif ?>
										<span class="nav-side__title"><?php echo $menu->title; ?></span>
									</a>
								</li>
							<?php endforeach ?>

							<?php foreach ($external as $k => $menu) : ?>
								<li class="nav-side__item" <?php echo $k == 0 ? 'style="padding-top: 6px; border-top: 1px solid #f1f1f1"' : '' ?>>
									<a class="nav-side__link" href="<?php echo $menu->url ?>" target="<?php echo $menu->target ?>" rel="<?php echo $menu->nofollow ? 'nofollow' : 'dofollow' ?>" title="<?php echo $menu->title ?>">
										<?php if ($menu->img) : ?>
											<img width="39" height="39" src="<?php echo '/' . DIR_THEME ?>rs/imgs/game_load.webp" data-src="<?php echo \helper\image::get_thumbnail($menu->img, 39, 39, 'm') ?>" class="lazy-image img-fluid nav-side__icon wp-post-image" decoding="async" loading="lazy" sizes="(max-width: 39px) 100vw, 39px" title="<?php echo $menu->title; ?>" alt="<?php echo $menu->title ?> img" />
										<?php endif ?>
										<span class="nav-side__title"><?php echo $menu->title; ?></span>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					</nav>
				</div>
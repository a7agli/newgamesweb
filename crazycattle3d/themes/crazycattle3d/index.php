<?php
$slug = \helper\options::options_by_key_type('slug_home');
$game = \helper\game::find_by_slug($slug);
if ($game == null) {
    load_response()->redirect('/new-games');
}
$post = \helper\posts::find_by_slug($slug);
if ($post != null) {
    $game->content = $post->content;
    $game->excerpt = $post->excerpt;
}
$metadata = json_decode($game->metadata);
if ($metadata->external == 'yes') {
    $external = \helper\menu::find_menu_by_menugroup('external');
}
$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_home');
echo \helper\themes::get_layout('header', array('custom' => $custom, 'is_blog' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu', array('external' => $external));
echo \helper\themes::get_layout('game_play', array('game' => $game, 'is_home' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('header/richtext_home', array('game' => $game));
echo \helper\themes::get_layout('footer');

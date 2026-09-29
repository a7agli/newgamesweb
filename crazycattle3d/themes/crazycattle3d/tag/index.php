<?php
$tag = \helper\tag::find_tag_by_slug($slug, 'game');
if (!$tag) {
    load_response()->redirect('/new-games');
}
$tag_id = $tag->id;

$title = strtolower($tag->name) . " games"; //action games games
$title = str_replace("games games", "games", $title);
$title = ucwords($title);
$tag->name = $title;
$description = $tag->description;
// $arr_bread = array(
//     array(
//         "name" => $tag->name,
//     ),
// );
$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_tag', array('tag' => $tag));
echo \helper\themes::get_layout('header', array('custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu');
echo \helper\themes::get_layout('game_item', array('tag_id' => $tag_id, 'title' => $title, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');

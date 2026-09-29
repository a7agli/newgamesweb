<?php
$category = \helper\category::find_category_by_slug($slug, 'game');
if (!$category) {
    load_response()->redirect('/new-games');
}
$category_id = $category->id;

$title = strtolower($category->name) . " games"; //action games games
$title = str_replace("games games", "games", ($title));
$title = ucwords($title);
$category->name = $title;
$description = $category->description;
//// bread_crumb.php
// $arr_bread = array(
//     array(
//         "name" => $category->name,
//     ),
// );
$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_category', array('category' => $category));
echo \helper\themes::get_layout('header', array('custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu');
echo \helper\themes::get_layout('game_item', array('category_id' => $category_id, 'title' => $title, 'field_order' => 'publish_date', 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');

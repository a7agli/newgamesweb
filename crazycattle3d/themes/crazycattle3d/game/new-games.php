<?php
$title = 'new games';
$description = 'Play new games at ' . \helper\options::options_by_key_type('site_name');

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_newgame');
echo \helper\themes::get_layout('header', array('custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu');
echo \helper\themes::get_layout('game_item', array('title' => $title, 'field_order' => 'publish_date', 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('footer');

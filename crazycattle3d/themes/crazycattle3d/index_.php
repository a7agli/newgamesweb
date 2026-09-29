<?php
$slogan = \helper\options::options_by_key_type('company_slogan', 'company');
$title = \helper\options::options_by_key_type('site_name');

$slug_home =  \helper\options::options_by_key_type('slug_home');
$post = \helper\posts::find_by_slug($slug_home);

$enable_ads = \helper\game::get_ads_control();

$custom = \helper\themes::get_layout('header/metadata_home');
echo \helper\themes::get_layout('header', array('custom' => $custom, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('menu');
echo \helper\themes::get_layout('game_item', array('post' => $post, 'slogan' => $slogan, 'title' => $title, 'is_home' => true, 'enable_ads' => $enable_ads));
echo \helper\themes::get_layout('header/richtext', array('game' => $game)); //schema
echo \helper\themes::get_layout('footer');

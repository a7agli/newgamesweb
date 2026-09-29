<?php
$data = $_REQUEST['data'];
echo $data;
if ($data != null) {
    $data_array = json_decode($data,1);
    var_dump($data_array);
    if ($data_array) {
        \mod\highscore\action\a_highscore::get_me()->save($data_array);
    }
}
echo 1;

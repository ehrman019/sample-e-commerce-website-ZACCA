<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

$dbh = get_db_connect();
session_start();

$err = [];
// new arrivalデータの取得
$new_arr_data = get_new_arrival_data($dbh);

//PICKUPデータの取得
$pickup_data = get_pickup_data($dbh);

//カテゴリーの取得
$category = get_category_name_list($dbh);

$title = 'ZACCA';
include_once('views/index_view.php');

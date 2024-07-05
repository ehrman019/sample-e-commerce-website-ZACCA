<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

// PICKUPデータの取得
$pickup_data = get_pickup_data($dbh);

// cagegory名称の取得
$category = get_category_name_list($dbh);

$title = '商品検索';
include_once('views/search_view.php');

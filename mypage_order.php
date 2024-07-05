<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

if (!$user = user_exists($dbh)) {
  redirect('logout.php');
}

$order_list = [];

$list = get_user_order($dbh, $user['user_id']);
foreach ($list as $value) {
  $order_list[] = get_order_detail($dbh, $value['order_id']);
}

$title = "注文履歴";
include_once('views/mypage_order_view.php');

<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();
$err = [];

// orderIDをポストで取得
// ポストがない場合はリストへリダイレクト
if (!isset_method('POST')) {
  redirect('order.php');
}

$order_id = get_post('id');
$order_data = get_order_data($dbh, $order_id);
$order_detail = get_order_detail($dbh, $order_id);


include('views/order_detail_view.php');

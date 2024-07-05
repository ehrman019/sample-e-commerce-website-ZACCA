<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

// PICK UPリストの取得
$pickup_data = get_pickup_data($dbh);

// ログイン済のときはデータベースからカートを取得
$cart = [];
if ($user = user_exists($dbh)) {
  $cart = get_cart_data($dbh, $user['user_id']);
} elseif (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
}

$title = 'カート';
include_once('views/cart_view.php');

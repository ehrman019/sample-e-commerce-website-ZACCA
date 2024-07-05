<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

// ログアウト状態のとき、ログインページへ遷移
if (!isset($_SESSION['user'])) {
  $_SESSION['order'] = true;
  redirect('login.php');
}

if (!$user = user_exists($dbh)) {
  redirect('logout.php');
}

if (!$order = get_cart_data($dbh, $user['user_id'])) {
  redirect('cart.php');
}

if (isset_method('POST')) {
  if (get_post('name') === 'order') {
    $order_name = $user['last_name'] . ' ' . $user['first_name'];
    $order_zipcode = $user['zipcode'];
    $order_address = $user['pref'] . $user['city'] . $user['address'];
    $order_building = $user['building'];
    $created_at = date("Y-m-d H:i:s");
    $data = [
      'user_id' => $user['user_id'],
      'order_name' => $order_name,
      'order_zipcode' => $order_zipcode,
      'order_address' => $order_address,
      'order_building' => $order_building,
      'created_at' => $created_at
    ];
    // 注文したユーザと日付をDBに登録
    insert_order_data($dbh, $data);
    // AUTOで設定された注文IDを取得
    $order_id = get_order_id($dbh, $user['user_id'], $created_at);
    foreach ($order as $value) {
      $data_detail = [
        'order_id' => $order_id['order_id'],
        'product_id' => $value['product_id'],
        'type_id' => $value['type_id'],
        'quantity' => $value['quantity']
      ];
      // 注文詳細をDBに登録
      insert_order_detail($dbh, $data_detail);

      $product_detail = get_type_name($dbh, $value['product_id'], $value['type_id']);
      $data_shipping = [
        'product_id' => $value['product_id'],
        'type_id' => $value['type_id'],
        'quantity' => $product_detail['quantity'] - $value['quantity']
      ];

      // 注文個数分の在庫を減らす
      update_product_quantity($dbh, $data_shipping);
    }
    // このユーザのカートを空にする
    delete_user_cart($dbh, $user['user_id']);

    // 注文完了画面へリダイレクト
    redirect('order_complete.php');
  }
}


$title = "購入手続き";
include_once("views/order_view.php");

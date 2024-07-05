<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

// PICK UPリストの取得
$pickup_data = get_pickup_data($dbh);

//商品idの取得
$product_id = (int)$_GET['id'];

//商品情報とタイプの取得
if (!$product = get_product_data($dbh, $product_id)) {
  redirect('404.php');
  //商品情報がなければ404へリダイレクト
}
if (!$type = get_type_data($dbh, $product_id)) {
  redirect('404.php');
  // タイプが登録されていない場合も404
}

// お気に入り登録
$favorite = 0;
if ($user = user_exists($dbh)) {
  $data = [
    'user_id' => $user['user_id'],
    'product_id' => $product_id
  ];
  if (favorite_exists($dbh, $data)) {
    $favorite = 1;
  }
}

$title = $product['product_name'];
include_once('views/product_view.php');

<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

// データ取得失敗の時はすべてリダイレクト
if (isset_method('POST')) {
  // どのボタンが押されたかを判別
  $process = get_post('process');
  switch ($process) {
      // 商品設定の時
    case 'product':
      $product_id = get_post('product-id');
      if (!$product_data = get_product_data($dbh, $product_id)) {
        $err['purchase'] = '商品が存在しません';
      }
      if (!$type_data = get_type_data($dbh, $product_id)) {
        $err['purchase_type'] = 'データを取得できません';
      }
      break;
      // タイプ設定の時
    case 'type':
      $product_id = get_post('product-id');
      $type_id = get_post('type-id');
      if (!$product_data = get_product_data($dbh, $product_id)) {
        $err['purchase'] = 'データを取得できません';
      }
      if (!$type_data = get_type_data($dbh, $product_id)) {
        $err['purchase_type'] = 'データを取得できません';
      }
      if (!$type_name = get_type_name($dbh, $product_id, $type_id)) {
        $err['purchase'] = 'データを取得できません';
      }
      break;
      // 入荷登録の時
    case 'purchase':
      $data = [
        'product_id' => (int)get_post('product-id'),
        'type_id' => (int)get_post('type-id'),
        'quantity' => (int)get_post('product-quantity'),
      ];

      if (!$type_name = get_type_name($dbh, $data['product_id'], $data['type_id'])) {
        redirect('purchase.php');
      }

      $data['quantity'] += $type_name['quantity'];
      update_purchase($dbh, $data);

      $_SESSION['url'] = 'purchase.php';
      redirect('complete.php');

      break;
    default:
      redirect('purchase.php');
      break;
  }
}

include_once('views/purchase_view.php');

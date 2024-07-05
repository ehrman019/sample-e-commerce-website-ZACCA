<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();

// データ取得失敗の場合すべてリダイレクト
if (isset($_GET['id']) && isset($_GET['img'])) {
  $product_id = (int)$_GET['id'];
  $img_num = (int)$_GET['img'];

  var_dump($product_id);
  var_dump($img_num);
  if (!$product_data = get_product_data($dbh, $product_id)) {
    redirect('edit_product.php');
  } elseif ($product_data['product_img_num'] < $img_num) {
    redirect('edit_product.php');
  }
  if ($product_id === 1 && 1 <= $img_num && $img_num <= 4) {
    redirect('edit_product_img.php?id=' . $product_id);
  } //既存は削除不可
  if (2 <= $product_id && $product_id <= 8 && $img_num === 1) {
    redirect('edit_product_img.php?id=' . $product_id);
  } //既存は削除不可
  $delete_img_name = '../img/' . $product_id . '_' . $img_num . '.jpg';
  if (!unlink($delete_img_name)) {
    redirect('edit_product_img.php?id=' . $product_id);
  }

  // 削除した画像以降の番号をずらす
  for ($i = $img_num; $i < $product_data['product_img_num']; $i++) {
    $img_name_from = '../img/' . $product_id . '_' . $i + 1 . '.jpg';
    $img_name_to = '../img/' . $product_id . '_' . $i . '.jpg';
    rename($img_name_from, $img_name_to);
  }

  // DBの画像枚数を1枚減らす
  update_product_img($dbh, $product_id, $product_data['product_img_num'] - 1);
  redirect('edit_product_img.php?id=' . $product_id);
} else {
  redirect('edit_product.php');
}

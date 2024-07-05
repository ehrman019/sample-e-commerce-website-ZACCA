<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();
$err = [];

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $product_data = get_product_data($dbh, $product_id);
  if ($category_data = get_category_name($dbh, $product_data['category_id'])) {
    $category_name = $category_data['category_name'];
  }
  $type_data = get_type_data($dbh, $product_data['product_id']);
} else {
  redirect('edit_product.php');
}

if (isset_method('POST')) {
  if ($_FILES['product-img']['name'][0]) {
    $product_images = $_FILES['product-img'];
  } else {
    $err['img'] = '画像を選択してください';
  }
  $count = 0;
  if (!isset($err['img'])) {
    $img_num = count($product_images['name']);
    for ($i = 0; $i < $img_num; $i++) {
      if ($product_data['product_img_num'] + $count >= 10) {
        $err['img'] = '登録できる画像は10枚までです';
        break;
      } elseif (!$img_type = exif_imagetype($product_images['tmp_name'][$i])) {
        $err['img'] = 'ファイルの読み取りに失敗しました';
        break;
      } elseif ($img_type !== IMAGETYPE_JPEG) {
        $err['img'] = '対象ファイルはJPEGのみです';
        break;
      } elseif ($product_images['size'][$i] > 512000) {
        $err['img'] = 'ファイルサイズは500KB以下にしてください';
        break;
      } else {
        $img_title = $product_data['product_id'] . '_' . ($product_data['product_img_num'] + 1 + $i) . '.jpg';
        if (!move_uploaded_file($product_images['tmp_name'][$i], '../img/' . $img_title)) {
          $err['img'] = 'ファイルのアップロードに失敗しました';
          break;
        }
        $count++;
      }
    }
  }


  if (!isset($err['img']) || $count > 0) {
    update_product_img($dbh, $product_data['product_id'], $product_data['product_img_num'] + $count);
    redirect('edit_product_img.php?id=' . $product_data['product_id']);
  }
}

include_once('views/edit_product_img_view.php');

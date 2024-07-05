<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

// 入力行の初期化
$input_row = 1;

// 商品データのIDを取得
if ($data = get_product_id($dbh)) {
  $first_id = $data['MAX(product_id)'] + 1;
} else {
  $first_id = 1;
}

// カテゴリーのデータの取得
if (!$category = get_category_name_list($dbh)) {
  $err['category'] = 'データを取得できません';
}

if (isset_method('POST')) {
  // ポストが入力行のときは数を変更
  if (get_post('input-row')) {
    $input_row = get_post('input-row');
    // ポストが登録の時
  } else {
    $input_row = get_post('input-row-submit');
    // 各行でバリデーション
    for ($i = 0; $i < $input_row; $i++) {
      if (!get_post('product-name-' . $i + 1)) {
        $err['register_product'][$i] = '商品名を入力してください';
        break;
      } elseif ((int)get_post('category-id-' . $i + 1) === 0) {
        $err['register_product'][$i] = 'カテゴリーを選択してください';
        break;
      }

      // タイプのバリデーション
      $type_name = get_array_post('type-name-' . $i + 1);

      if ($type_name) {
        foreach ($type_name as $j => $value) {
          if (!$value && $j === 0) {
            $err['register_product'][$i] = 'タイプを入力してください';
          }
        }
      }
    }
    // エラーが無いとき登録
    if (!isset($err['register_product'])) {
      for ($i = 0; $i < $input_row; $i++) {
        $data = [
          'product_name' => get_post('product-name-' . $i + 1),
          'product_price' => (int)get_post('product-price-' . $i + 1),
          'product_description' => null,
          'category_id' => (int)get_post('category-id-' . $i + 1),
          'pickup' => (int)get_post('pickup-' . $i + 1),
        ];
        insert_product_data($dbh, $data);

        // タイプの登録
        $type_name = get_array_post('type-name-' . $i + 1);
        $insert_data = get_product_id($dbh);
        $product_id = $insert_data['MAX(product_id)'];

        // タイプの入力が無い場合、デフォルトを登録
        if (!$type_name) {
          $type_data = [
            'product_id' => $product_id,
            'type_id' => 1,
            'type_name' => 'ナシ'
          ];
          insert_type_data($dbh, $type_data);
        } else {
          foreach ($type_name as $j => $value) {
            if ($value) {
              $type_data = [
                'product_id' => $product_id,
                'type_id' => $j + 1,
                'type_name' => $value
              ];
              insert_type_data($dbh, $type_data);
            } else {
              // ２行目以降が空欄の場合終了
              break;
            }
          }
        }
      }
      $_SESSION['url'] = 'register_product.php';
      redirect('complete.php');
    }
  }
}

include_once('views/register_product_view.php');

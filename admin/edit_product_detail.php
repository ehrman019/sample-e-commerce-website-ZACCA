<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();

// 商品IDをGETで取得
// ない場合リストへリダイレクト
if (isset($_GET['id'])) {
  $product_id = (int)$_GET['id'];
  if (!$product_data = get_product_data($dbh, $product_id)) {
    $err['product_data'] = 'データを取得できません';
  }
} else {
  redirect('edit_prod.php');
}

if (!$category = get_category_name_list($dbh)) {
  $err['category'] = 'データを取得できません';
}

if ($type_list = get_type_data($dbh, $product_data['product_id'])) {
  // タイプは必ず1つ以上登録されている
  $type_num = count($type_list);
} elseif (is_array($type_list)) {
  // 登録されていない場合
  $type_num = 0;
} else {
  $err['type'] = 'データを取得できません';
}

if (isset_method('POST')) {
  // バリデーション
  if (!get_post('product-name')) {
    $err['edit_prod'] = '商品名は入力必須です';
  } elseif (!get_post('product-name')) {
  } elseif ((int)get_post('category-id') === 0) {
    $err['edit_prod'] = 'カテゴリーを選択してください';
  }
  if (!isset($err['edit_prod'])) {
    $data = [
      'product_id' => $product_id,
      'product_name' => get_post('product-name'),
      'product_price' => (int)get_post('product-price'),
      'product_description' => get_post('product-description'),
      'category_id' => (int)get_post('category-id'),
      'pickup' => (int)get_post('pickup'),
    ];

    update_product_data($dbh, $data);

    // タイプを登録
    if (!isset($err['edit_prod'])) {
      $type_name = get_array_post('type-name-1');
      $edit_type_data = [];

      // 入力がない場合
      if (!$type_name) {
        $edit_type_data[] = [
          'product_id' => $product_id,
          'type_id' => 1,
          'type_name' => 'none'
        ];
      } else {
        // 入力内容をアップデート用の配列に格納
        foreach ($type_name as $j => $value) {
          if (!$type_name[$j]) {
            break;
          } else {
            $edit_type_data[] = [
              'product_id' => $product_id,
              'type_id' => $j + 1,
              'type_name' => $type_name[$j]
            ];
          }
        }
      }

      var_dump($type_name);

      $edit_type_num = count($edit_type_data);

      var_dump($edit_type_data);
      for ($j = 0; $j < min($type_num, $edit_type_num); $j++) {
        update_type_data($dbh, $edit_type_data[$j]);
      }

      // 元の個数が編集後の個数より少ない場合insert
      if ($type_num < $edit_type_num) {
        for ($j = $type_num; $j < $edit_type_num; $j++) {
          insert_type_data($dbh, $edit_type_data[$j]);
        }
        // 元の個数が編集後の個数より多い場合delete
      } else {
        for ($j = $edit_type_num; $j < $type_num; $j++) {
          delete_type_data($dbh, $type_list[$j]);
        }
      }
    }
  }
  if (!isset($err['edit_prod'])) {
    redirect('product.php?id=' . $product_id);
  }
}

include_once('views/edit_product_detail_view.php');

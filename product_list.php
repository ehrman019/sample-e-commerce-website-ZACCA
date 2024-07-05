<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

if (isset($_GET['name']) && isset($_GET['page'])) {
  $name = $_GET['name'];
  $page = (int)$_GET['page'];

  switch ($name) {
    case 'pickup':
      $title = 'PICK UP';
      $title_h1 = 'PICK UP';
      $sub_title = 'ピックアップ';
      $list = get_pickup_data($dbh);
      break;
    case 'new_arr':
      $title = '新着商品';
      $title_h1 = 'NEW ARRIVAL';
      $sub_title = '新着商品';
      $list = get_new_arrival_data($dbh);
      break;
    case 'list':
      $title = '商品一覧';
      $title_h1 = 'PRODUCTS';
      $sub_title = '商品一覧';
      $list = get_new_arrival_data($dbh);
      break;
    case 'category':
      $category_id = $_GET['id'];
      if ($category_name = get_category_name($dbh, $category_id)) {
        $title = 'カテゴリー : ' . $category_name['category_name'];
      } else {
        redirect('404.php');
      }
      $title_h1 = 'PRODUCTS';
      $sub_title = '商品一覧';
      $note = $title;
      $list = get_category_data($dbh, $category_id);
      break;
    case 'search':
      $word = $_GET['word'];
      $title = 'キーワード検索 : ' . $word;
      $note = $title;
      $title_h1 = 'PRODUCTS';
      $sub_title = '商品一覧';
      $list = search_product($dbh, $word, $word);
      break;
    case 'favorite':
      $title = 'お気に入り一覧';
      $title_h1 = 'FAVORITE';
      $sub_title = 'お気に入り一覧';
      if ($user = user_exists($dbh)) {
        $list = get_favorite_data($dbh, $user['user_id']);
      } else {
        redirect('logout.php');
      }
      break;
    default:
      redirect('product_list.php?name=list&page=1');
  }
} else {
  redirect('product_list.php?name=list&page=1');
}

$length = count($list);
$pagenum = floor($length / 16) + 1;

$left = 16 * ($page - 1);
if ($left + 16 > $length) {
  $right = $length;
} else {
  $right = $left + 16;
}

// titleは上記の分岐で設定
include_once('views/product_list_view.php');

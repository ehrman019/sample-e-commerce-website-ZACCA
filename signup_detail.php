<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

// メールとPWDのデータが消えていた場合リダイレクト
if (!isset($_SESSION['signup'])) {
  redirect('signup.php');
}

// 値の受け取り
$data = [];
$data['year'] = 0;
$prev_y = 0;

if (isset_method('POST')) {

  $data['email'] = $_SESSION['signup']['email'];
  $data['pwd'] = $_SESSION['signup']['pwd'];

  $data['last_name'] = get_post('last-name');
  $data['first_name'] = get_post('first-name');
  $data['last_name_kana'] = get_post('last-name-kana');
  $data['first_name_kana'] = get_post('first-name-kana');
  $data['gender'] = (int)get_post('gender');
  $data['year'] = (int)get_post('year');
  $data['month'] = (int)get_post('month');
  $data['day'] = (int)get_post('day');
  $data['zipcode'] = get_post('zipcode');
  $data['prefecture'] = (int)get_post('prefecture');
  $data['city'] = get_post('city');
  $data['address'] = get_post('address');
  $data['building'] = get_post('building');
  $data['tel'] = get_post('tel');

  // バリデーション
  $validate_length = [
    'address' => '番地',
    'city' => '市区町村',
    'last_name_kana' => 'ふりがな',
    'first_name_kana' => 'ふりがな',
    'last_name' => 'お名前',
    'first_name' => 'お名前',
  ];

  $validate_select = [
    'prefecture' => '都道府県',
    'year' => '生年月日',
    'month' => '生年月日',
    'day' => '生年月日',
    'gender' => '性別'
  ];

  if (!preg_match('/^\d{2,4}-?\d{3,4}-?\d{4}$/', $data['tel'])) {
    $err['signup_detail'] = '電話番号の形式が正しくありません';
  }

  if (mb_strlen($data['building']) > 50) {
    $err['signup_detail'] = '建物名は50文字以内にしてください';
  }

  if (!preg_match('/^\d{3}-\d{4}$/', $data['zipcode'])) {
    $err['signup_detail'] = '郵便番号は7桁、ハイフンを入れてください';
  }

  foreach ($validate_length as $key => $value) {
    if (mb_strlen($data[$key]) === 0) {
      $err['signup_detail'] = $value . 'は必須項目です。';
    }
    if (mb_strlen($data[$key]) > 50) {
      $err['signup_detail'] = $value . 'は50文字以内にしてください。';
    }
  }

  foreach ($validate_select as $key => $value) {
    if (!$data[$key]) {
      $err['signup_detail'] = $value . 'を選択してください';
    }
  }

  // エラー時は送信前のページ位置へスクロール
  $prev_y = (int)get_post('prev-y');

  var_dump($prev_y);

  // エラーがない場合DBに登録
  if (empty($err['signup_detail'])) {
    insert_user_data($dbh, $data);
    $user = email_exists($dbh, $data['email']);
    if ($user['pwd'] === $data['pwd']) {
      // カートに商品があればユーザのカートDBに加える
      if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $value) {
          add_to_cart($dbh, $value, $user['user_id']);
        }
        unset($_SESSION['cart']);
      }
      // セッションにユーザIDを格納
      session_regenerate_id();
      $_SESSION['user'] = $user['user_id'];

      if (isset($_SESSION['order'])) {
        // 購入手続き前の新規登録の時はカートへ遷移
        redirect('cart.php');
      } elseif (isset($_SESSION['favorite'])) {
        // お気に入り登録のログイン時は商品ページへ遷移
        $product_id = $_SESSION['favorite'];
        $data = [
          'user_id' => $user['user_id'],
          'product_id' => $product_id
        ];
        if (!favorite_exists($dbh, $data)) {
          add_favorite($dbh, $data);
        }
        redirect('product.php?id=' . $product_id);
      } else {
        // その他の場合はマイページに遷移
        redirect('mypage.php');
      }
    }
  }
}

$title = '新規登録';
include_once('views/signup_detail_view.php');

<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

//セッションがあればマイページに遷移

if ($user = user_exists($dbh)) {
  redirect('mypage.php');
}

//メールアドレス、パスワードのバリデーション
if (isset_method('POST')) {
  $email = get_post('email');
  $pwd = get_post('pwd');

  $dbh = get_db_connect();

  if (mb_strlen($email) === 0) {
    $err['login'] = 'メールアドレスを入力してください。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['login'] = 'メールアドレスの形式が正しくありません。';
  } elseif (mb_strlen($pwd) < 8 || mb_strlen($pwd) > 32) {
    $err['login'] = 'パスワードは8文字以上32文字以下です。';
  } elseif (!email_exists($dbh, $email)) {
    $err['login'] = 'パスワードが間違っています。';
  }

  //データベースにあるかのバリデーション
  if (!isset($err['login'])) {
    if ($user = login($dbh, $email, $pwd)) {
      // カートに商品があればユーザのカートに加える
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
        // 購入手続き前のログインの時はカートへ遷移
        unset($_SESSION['order']);
        redirect('cart.php');
      } elseif (isset($_SESSION['favorite'])) {
        // お気に入り登録のログイン時は商品ページへ遷移
        $product_id = $_SESSION['favorite'];
        if ($product = get_product_data($dbh, $product_id)) {
          $data = [
            'user_id' => $user['user_id'],
            'product_id' => $product_id
          ];
          if (!favorite_exists($dbh, $data)) {
            add_favorite($dbh, $data);
          }
        }
        unset($_SESSION['favorite']);
        redirect('product.php?id=' . $product_id);
      } else {
        // その他の場合はマイページに遷移
        redirect('mypage.php');
      }
    } else {
      $err['login'] = 'パスワードが間違っています。';
    }
  }
}

$title = 'ログイン';
include_once('views/login_view.php');

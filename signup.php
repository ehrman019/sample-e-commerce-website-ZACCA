<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

if (isset_method('POST')) {
  $name = get_post('name');
  $email = get_post('email');
  $pwd = get_post('pwd');
  $repwd = get_post('repwd');

  if (email_exists($dbh, $email)) {
    $err['signup'] = 'このメールアドレスは登録できません';
  } elseif (mb_strlen($email) === 0) {
    $err['signup'] = 'メールアドレスは必須です。';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['signup'] = 'メールアドレスの形式が正しくありません';
  } elseif (mb_strlen($pwd) < 8 || mb_strlen($pwd) > 32) {
    $err['signup'] = 'パスワードは8文字以上32文字以下で設定してください';
  } elseif ($pwd !== $repwd) {
    $err['signup'] = '再入力のパスワードが異なっています。';
  } elseif (!preg_match(PWD_REGEX, $pwd)) {
    $err['signup'] = 'パスワードは英字と数字の両方を使用してください';
  }

  if (!isset($err['signup'])) {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $_SESSION['signup']['email'] = $email;
    $_SESSION['signup']['pwd'] = $pwd;
    redirect('signup_detail.php');
  }
}

$title = '新規登録';
include_once('views/signup_view.php');

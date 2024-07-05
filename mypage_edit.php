<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];

$prev_y = 0;

if (!$user = user_exists($dbh)) {
  redirect('logout.php');
}

if (isset_method('POST')) {
  // エラー時のページ位置を保持
  $prev_y = get_post('prev-y');
  // 各々バリデーション、エラーなしでDB登録
  switch (get_post('process')) {
    case 'email':
      $email = get_post('email');
      $re_email = get_post('re-email');
      if (mb_strlen($email) === 0) {
        $err['email'] = '新しいメールアドレスを入力してください';
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err['email'] = 'メールアドレスの形式が正しくありません';
      } elseif ($email !== $re_email) {
        $err['email'] = '再入力のメールアドレスが異なっています';
      } elseif (email_exists($dbh, $email)) {
        $err['email'] = 'このメールアドレスは登録できません';
      } else {
        update_user_email($dbh, $user['user_id'], $email);
        redirect('mypage_edit_complete.php');
      }
      break;
    case 'pwd':
      $prev_pwd = get_post('prev-pwd');
      $pwd = get_post('pwd');
      $re_pwd = get_post('re-pwd');

      if (!login($dbh, $user['email'], $prev_pwd)) {
        $err['pwd'] = '現在のパスワードが異なっています';
      } elseif (mb_strlen($pwd) < 8 || mb_strlen($pwd) > 32) {
        $err['pwd'] = 'パスワードは8文字以上32文字以下で設定してください';
      } elseif ($pwd !== $re_pwd) {
        $err['pwd'] = '再入力のパスワードが異なっています';
      } elseif (!preg_match(PWD_REGEX, $pwd)) {
        $err['pwd'] = 'パスワードは英字と数字の両方を使用してください';
      } else {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        update_user_pwd($dbh, $user['user_id'], $pwd);
        redirect('mypage_edit_complete.php');
      }
      break;
    case 'name':
      $data['last_name'] = get_post('last-name');
      $data['first_name'] = get_post('first-name');
      $data['last_name_kana'] = get_post('last-name-kana');
      $data['first_name_kana'] = get_post('first-name-kana');

      $validate_length = [
        'last_name_kana' => 'ふりがな',
        'first_name_kana' => 'ふりがな',
        'last_name' => 'お名前',
        'first_name' => 'お名前',
      ];

      foreach ($validate_length as $key => $value) {
        if (mb_strlen($data[$key]) === 0) {
          $err['name'] = $value . 'を入力してください';
        }
        if (mb_strlen($data[$key]) > 50) {
          $err['name'] = $value . 'は各50文字以内にしてください';
        }
      }
      if (!isset($err['name'])) {
        update_user_name($dbh, $user['user_id'], $data);
        redirect('mypage_edit_complete.php');
      }
      break;
    case 'address':
      $data['zipcode'] = get_post('zipcode');
      $data['prefecture'] = get_post('prefecture');
      $data['city'] = get_post('city');
      $data['address'] = get_post('address');
      $data['building'] = get_post('building');

      $validate_length = [
        'address' => '番地',
        'city' => '市区町村'
      ];

      foreach ($validate_length as $key => $value) {
        if (mb_strlen($data[$key]) === 0) {
          $err['address'] = $value . 'は必須です';
        }
        if (mb_strlen($data[$key]) > 50) {
          $err['address'] = $value . 'は50文字以内にしてください';
        }
      }

      if (!$data['prefecture']) {
        $err['address'] = '都道府県を選択してください';
      }

      if (!preg_match('/^\d{3}-\d{4}$/', $data['zipcode'])) {
        $err['address'] = '郵便番号は7桁、ハイフンを入れてください';
      }

      if (!isset($err['address'])) {
        update_user_address($dbh, $user['user_id'], $data);
        redirect('mypage_edit_complete.php');
      }
      break;
    case 'tel':
      $tel = get_post('tel');
      if (!preg_match('/^\d{2,4}-?\d{3,4}-?\d{4}$/', $tel)) {
        $err['tel'] = '電話番号の形式が正しくありません';
      } else {
        update_user_tel($dbh, $user['user_id'], $tel);
        redirect('mypage_edit_complete.php');
      }
      break;
    default:
      redirect('mypage.php');
      break;
  }
}


$title = 'お客様情報編集';
include_once('views/mypage_edit_view.php');

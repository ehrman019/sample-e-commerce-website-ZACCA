<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
$err = [];
$prev_y = 0;

if (isset_method('POST')) {

  $data = [
    'contact_name' => get_post('name'),
    'contact_email' => get_post('email'),
    'contact_tel' => get_post('tel'),
    'contact_message' => get_post('message')
  ];

  if (mb_strlen($data['contact_name']) === 0) {
    $err['contact'] = 'お名前は必須項目です';
  } elseif (mb_strlen($data['contact_name']) > 50) {
    $err['contact'] = 'お名前は50文字以内です';
  }

  if (mb_strlen($data['contact_email']) === 0) {
    $err['contact'] = 'メールアドレスは必須です';
  } elseif (!filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
    $err['contact'] = 'メールアドレスの形式が正しくありません';
  }

  if (mb_strlen($data['contact_tel']) > 0  && !preg_match('/^\d{2,4}-?\d{3,4}-?\d{4}$/', $data['contact_tel'])) {
    $err['contact'] = '電話番号の形式が正しくありません';
  }

  if (mb_strlen($data['contact_message']) === 0) {
    $err['contact'] = 'お問い合わせ内容は必須項目です';
  } elseif (mb_strlen($data['contact_message']) > 500) {
    $err['contact'] = 'お問い合わせ内容は500文字以内です';
  }

  // エラー時は送信前のページ位置へスクロール
  $prev_y = (int)get_post('prev-y');

  // エラーが無い場合DBに登録
  if (!isset($err['contact'])) {
    //insert_contact_data($dbh, $data);
    //ポートフォリオ公開用に登録なしにする
  }

  if (!isset($err['contact'])) {
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');

    $admin_subject = 'お問い合わせがありました';
    $admin_message = <<<EOM

    {$data['contact_name']} 様からお問い合わせがありました。

    ===============================

    {$data['contact_message']}

    EOM;
    // 管理者宛
    //send_mail(ADMIN_EMAIL, $admin_subject, $admin_message, ADMIN_NAME, ADMIN_EMAIL);

    $to = $data['contact_email'];
    $subject = 'お問い合わせありがとうございます  |  ZACCA';
    $message = <<<EOM
    {$data['contact_name']} 様

    お問い合わせありがとうございます。
    以下の内容で承りました。

    ===============================

    {$data['contact_message']}

    ===============================

    EOM;

    // ユーザ宛
    if (send_mail($to, $subject, $message, ADMIN_NAME, ADMIN_EMAIL)) {
      redirect('contact_complete.php');
    } else {
      $err['contact'] = '送信に失敗しました';
    }
  }
}

$title = 'お問い合わせ';
include_once('views/contact_view.php');

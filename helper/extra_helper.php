<?php

function html_escape($word)
{
  return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

function get_post($key)
{
  if (isset($_POST[$key])) {
    return trim($_POST[$key]);
  }
}

function get_array_post($key)
{
  if (isset($_POST[$key])) {
    if (!is_array($_POST[$key])) {
      return [$_POST[$key]];
    } else {
      return $_POST[$key];
    }
  }
}

function isset_method($key)
{
  if ($_SERVER['REQUEST_METHOD'] === $key) {
    return true;
  } else {
    return false;
  }
}

function redirect($page)
{
  header("Location: " . $page);
  exit;
}

function send_mail($to, $subject, $message, $from_name, $from_email)
{
  $headers = '';
  $headers .= "Content-Type: text/plain \r\n";
  $headers .= "Return-Path: " . $from_email . "\r\n";
  $headers .= "From: " . $from_name . "<" . $from_email . ">\r\n";
  $headers .= "Sender: " . $from_name .  "<" . $from_email . ">\r\n";
  $headers .= "Reply-to: " . $from_email . "\r\n";
  $headers .= "Organization: " . $from_name . "\r\n";

  if (mb_send_mail($to, $subject, $message, $headers)) {
    return true;
  } else {
    return false;
  }
}

function format_date($data)
{
  $date = new DateTime($data);
  return $date->format('Y/m/d H:i:s');
}

// 性別
$gender = ['男性', '女性', 'その他'];

// 都道府県名
$prefectures = ['北海道', '青森県', '岩手県', '秋田県', '宮城県', '山形県', '福島県', '東京都', '神奈川県', '千葉県', '埼玉県', '茨城県', '栃木県', '群馬県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '滋賀県', '三重県', '岡山県', '広島県', '鳥取県', '島根県', '山口県', '香川県', '徳島県', '高知県', '愛媛県', '福岡県', '大分県', '佐賀県', '長崎県', '熊本県', '宮崎県', '鹿児島県', '沖縄県'];

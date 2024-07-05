<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

//カートに入れたときデータを格納
if (isset_method('POST')) {
  //JSからデータを取得
  header('Content-Type: application/json;  charset=UTF-8');
  $js_data = file_get_contents('php://input');
  $data = json_decode($js_data, true);

  // ログインしている場合DBに登録
  // ログインしていない場合セッションに登録
  $user_id = null;
  if ($user = user_exists($dbh)) {
    $user_id = $user['user_id'];
  }

  echo json_encode(add_to_cart($dbh, $data, $user_id));
}

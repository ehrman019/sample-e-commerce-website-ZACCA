<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

if (isset_method('POST')) {
  //JSからデータを取得
  header('Content-Type: application/json; charset=UTF-8');
  $js_data = file_get_contents('php://input');
  $product_id = json_decode($js_data);

  if (!isset($_SESSION['user'])) {
    $_SESSION['favorite'] = $product_id;
    $res = 'logout';
    echo json_encode($res);
  } elseif (!user_exists($dbh)) {
    $res = 'logout';
    echo json_encode($res);
  } else {
    $res = 'login';

    $data = [
      'user_id' => $_SESSION['user'],
      'product_id' => $product_id
    ];
    if (!favorite_exists($dbh, $data)) {
      add_favorite($dbh, $data);
      echo json_encode($res);
    } else {
      delete_favorite($dbh, $data);
      echo json_encode($res);
    }
  }
} else {
  $res = 'index';
  echo json_encode($res);
}

<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

if (isset_method('POST')) {
  //再計算時のデータを取得
  header('Content-Type: application/json; charset=UTF-8');
  $js_data = file_get_contents('php://input');
  $cart = json_decode($js_data, true);

  $user_id = null;
  if (isset($_SESSION['user'])) {
    if (!$user = user_exists($dbh)) {
      redirect('logout.php');
    }
    foreach ($cart as $value) {
      $value['user_id'] =  $user['user_id'];
      update_cart_data($dbh, $value);
    }
  } else {
    $_SESSION['cart'] = $cart;
  }

  echo json_encode($cart);
}

<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

//削除ボタンが押されたとき
if (isset($_GET['id']) && isset($_GET['type'])) {
  $product_id = (int)$_GET['id'];
  $type_id = (int)$_GET['type'];

  if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    $delete_data = [
      'user_id' => $user_id,
      'product_id' => $product_id,
      'type_id' => $type_id
    ];
    delete_cart_data($dbh, $delete_data);
    redirect('cart.php');
  } elseif (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['product_id'] === $product_id && $value['type_id'] === $type_id) {
        unset($_SESSION['cart'][$key]);
      }
    }
    redirect('cart.php');
  }
}

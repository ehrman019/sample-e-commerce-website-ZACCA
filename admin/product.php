<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();
$err = [];

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $product_data = get_product_data($dbh, $product_id);

  if ($category_data = get_category_name($dbh, $product_data['category_id'])) {
    $category_name = $category_data['category_name'];
  }
  $type_data = get_type_data($dbh, $product_data['product_id']);
}

include_once('views/product_view.php');

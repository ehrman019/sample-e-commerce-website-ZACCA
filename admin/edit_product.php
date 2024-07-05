<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();
$list = [];

$list = get_product_all($dbh);

if (isset_method('POST')) {
  if (get_post('process') === 'edit-id') {
    $edit_id = get_post('edit-id');
    if ($data = get_product_data($dbh, $edit_id)) {
      $list = [$data];
    } else {
      $list = [];
    }
  } elseif (get_post('process') === 'edit-name') {
    $edit_name =  get_post('edit-name');
    $list = search_product($dbh, $edit_name);
  }
}

include_once('views/edit_product_view.php');

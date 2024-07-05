<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();
$err = [];

if (isset_method('POST')) {
  $user_id = get_post('id');
  $user = get_user_data($dbh, $user_id);
} else {
  redirect('users.php');
}

include_once('views/users_detail_view.php');

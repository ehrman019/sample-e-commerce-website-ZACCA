<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();
if (isset($_SESSION['user'])) {
  $user_id = $_SESSION['user'];
  if ($user_id = 1) {
    redirect('login.php');
  }
  delete_user($dbh, $user_id);
  redirect('delete_complete.php');
} else {
  redirect('login.php');
}

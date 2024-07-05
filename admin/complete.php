<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

if (isset($_SESSION['url'])) {
  $url = $_SESSION['url'];
} else {
  redirect('admin.php');
}

include_once('views/complete_view.php');

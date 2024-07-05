<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

$session_name = session_name();
$_SESSION = [];

if (isset($_COOKIE[$session_name])) {
  setcookie($session_name, '', time() - 3600);
}
session_destroy();

$title = 'アカウント削除';
include_once('views/delete_complete_view.php');

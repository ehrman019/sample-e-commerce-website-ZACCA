<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

if (!$user = user_exists($dbh)) {
  redirect('logout.php');
}
$fav_data = get_favorite_data($dbh, $user['user_id']);


$title = 'マイページ';
include_once('views/mypage_view.php');

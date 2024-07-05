<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

$title = '変更しました';
include_once('views/mypage_edit_complete_view.php');

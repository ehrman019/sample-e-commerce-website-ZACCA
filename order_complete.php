<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

$title = "ご注文ありがとうございます";
include_once('views/order_complete_view.php');

<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();
$dbh = get_db_connect();

$title = 'お買い物ガイド';
include_once('views/guide_view.php');

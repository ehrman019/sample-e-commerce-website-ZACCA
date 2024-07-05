<?php

require_once('config.php');
require_once('helper/db_helper.php');
require_once('helper/extra_helper.php');

session_start();

$title = 'ページが見つかりません';
include_once('views/404_view.php');

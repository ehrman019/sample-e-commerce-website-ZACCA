<?php

require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();

$gender = [ '男性', '女性', 'その他'];

$list = get_all_user($dbh);

include_once('views/users_view.php');
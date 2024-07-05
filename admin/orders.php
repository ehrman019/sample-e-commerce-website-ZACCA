<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();

$list = get_order_all($dbh);

include('views/orders_view.php');

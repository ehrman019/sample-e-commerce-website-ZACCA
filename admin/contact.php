<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();

$contact_list = get_contact_all($dbh);
  
include_once('views/contact_view.php');

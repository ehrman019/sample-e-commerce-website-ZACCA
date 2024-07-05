<?php
require_once('../config.php');
require_once('../helper/db_helper.php');
require_once('../helper/extra_helper.php');

$dbh = get_db_connect();

if (isset_method('POST')) {
  $contact_id = get_post('id');
  $contact_data = get_contact_data($dbh, $contact_id);
}

include('views/contact_detail_view.php');

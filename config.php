<?php

define('DSN', 'mysql:dbname=zacca;host=localhost;charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('SITE_URL', 'http://localhost/');
define('PWD_REGEX', '/^(?=.*[0-9])(?=.*[a-zA-z])\S+$/');
define('ADMIN_NAME', 'ZACCA');
define('ADMIN_EMAIL', 'sample@example.com');

error_reporting(E_ALL & ~E_NOTICE);
session_set_cookie_params(1440, '/');

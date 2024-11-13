<?php

define("DB_USER","root");
define("DB_PASSWORD","");
define("DB_NAME","scandiweb");
define("DB_TYPE","mysql");
define("DB_HOST","localhost");
define('DB_CHARSET', 'utf8');

$protocol = isset($_SERVER['HTTPS']) && 
$_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$base_url = $protocol . $_SERVER['HTTP_HOST'] . '/';
define('BASE_URL', $base_url);
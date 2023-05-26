<?php

CONST DATABASE = [
    'host' => 'localhost',
    'port' => '3306',
    'name' => 'project002',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8'
];

// define constants for error logging
define('LOG_ERRORS', true);
define('ERROR_LOG_FILE', __DIR__ . '/logs/errors.log');

// configure error logging
if (LOG_ERRORS) {
  ini_set('log_errors', 'On');
  ini_set('error_log', ERROR_LOG_FILE);
  error_reporting(E_ALL);
} else {
  ini_set('log_errors', 'Off');
  error_reporting(0);
}

?>
<?php
session_start();

$_SESSION['user_logged_in'] = false;
$_SESSION['user_email']     = null;

header('HTTP/1.1 302 Redirect');
header('Location: /');

?>
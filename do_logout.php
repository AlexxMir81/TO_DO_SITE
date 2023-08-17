<?php
require_once 'config.php';
$_SESSION['user_id'] = null;
header("Location:/pages//auth/login.php");

<?php

include "db.php";
session_start();

$_SESSION['username'] ='';
$_SESSION['email'] = '';
$_SESSION['last_login_date'] = '';
$_SESSION['weight_stat'] = '';
$_SESSION['hips_stat'] = '';
$_SESSION['belly_stat'] = '';
$_SESSION['waist_stat'] = '';
$_SESSION['le_stat'] = '';
$_SESSION['chest_stat'] = '';
$_SESSION['forearm_stat'] = '';
$_SESSION['biceps_stat'] = '';
$_SESSION['neck_stat'] = '';
$_SESSION['language'] = '';
$_SESSION['user_db'] = '';

session_destroy();
header("Location: ../index.php");

?>

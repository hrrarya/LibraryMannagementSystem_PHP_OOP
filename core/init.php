<?php 
	include 'database/config.php';
	include 'classes/user.php';

	session_start();
	global $pdo;

	$user = new User($pdo);
	define("BASE_URL", "http://localhost/phplms")
 ?>
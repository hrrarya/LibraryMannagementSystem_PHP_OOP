<?php 
	$dsn = 'mysql:host=localhost;dbname=lms';
	$user = 'root';
	$pass = '';

	try{
		$pdo = new PDO($dsn,$user,$pass);
	}
	catch(PDOException $e){
		echo 'connection failed'.$e->getMessage();
	}
 ?>
<?php
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$leNum = intval($_GET['id']);
	$rDelete = $pdo->prepare("DELETE FROM `services` WHERE `num_service` = ?");
	$done = $rDelete->execute(array($leNum));
	if ($done) {
		header("Location: services.php");
		exit();
	}else{
		header("Location: services.php");
		exit();
	}
?>
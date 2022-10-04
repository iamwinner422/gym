<?php
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$leNum = intval($_GET['id']);
	$rDelete = $pdo->prepare("DELETE FROM `utilisateurs` WHERE `num_user` = ?");
	$done = $rDelete->execute(array($leNum));
	if ($done) {
		header("Location: users.php");
		exit();
	}else{
		header("Location: users.php");
		exit();
	}
?>
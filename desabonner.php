<?php
session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	if (empty($_SESSION['num'])) {
		header("Location: index.php#connexion.php");
		exit();
	}


	if (isset($_GET['id']) and is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		$reqt = $pdo->prepare("DELETE FROM `abonnements` WHERE `num_ab` = ?");
		$done = $reqt->execute(array($id));
		if ($done) {
			header("Location: moncompte.php");
		}else{
			header("Location: moncompte.php");
		}
	}else{
		header("Location: moncompte.php");
	}
?>
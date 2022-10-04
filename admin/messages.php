<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	if (empty($_SESSION['num'])) {
		header("Location: login.php");
	}
	/*MESSAGES*/
	$reqMsg = $pdo->prepare("SELECT * FROM `messages` ORDER BY `num_msg` DESC");
	$reqMsg->execute();
	$nbMsg = $reqMsg->rowCount();
	$listeMsg = $reqMsg->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include 'menu.php';?>
	<div class="inform">
		<div class="leblock">
			<p>Nombre de méssage: <i class="nb"><?php echo $nbMsg;?></i></p>
		</div>
	</div>
	<div class="lesclasses">
		<h2>Liste des méssages</h2>
		<table class="tble" cellpadding="0" cellspacing="0" border="0" id="t4"> 
			<tr class="entete">
				<td style="padding-left: 2%;">Adresse de l'envoyeur</td>
				<td>Objet</td>
				<td>Message</td>
				<td align="center">Opérations</td>
			</tr>
			<?php foreach ($listeMsg as $msg) {?>
			<tr class='infos'>
				<td style="padding-left: 2%;"><?php echo $msg['email_envoyeur'];?></td>
				<td><?php echo $msg['sujet'];?></td>
				<td><?php echo $msg['message'];?></td>
				<td align="center"><a href="supp_m.php?id=<?php echo $msg['num_msg'];?>" class="suppS">Supprimer</a></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
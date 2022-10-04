<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	if (empty($_SESSION['num'])) {
		header("Location: login.php");
	}

	/*ABONNEMENT*/
	$reqAbm = $pdo->prepare("SELECT num_ab, adr_mail, libelle_service, jours, heure, date_ab FROM  `services` S, `abonnements` A, `utilisateurs` U WHERE `S`.num_service = `A`.num_service AND `A`.num_user = `U`.num_user ORDER BY `num_ab` DESC");
	$reqAbm->execute();
	$nbAbm = $reqAbm->rowCount();
	$listeAbm = $reqAbm->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Abonnements</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include 'menu.php';?>
	<div class="inform">
		<div class="leblock">
			<p>Nombre d'abonnements: <i class="nb"><?php echo $nbAbm;?></i></p>
		</div>
	</div>
	<div class="lesclasses">
		<h2>Liste des abonnements</h2>
		<table class="tble" cellpadding="0" cellspacing="0" border="0" id="t3"> 
			<tr class="entete">
				<td style="padding-left: 2%;">Adresse de l'utilisateur</td>
				<td>Service</td>
				<td>Jours</td>
				<td>Heure</td>
				<td align="center">Date d'abonnement</td>
			</tr>
			<?php foreach ($listeAbm as $abm) {?>
			<tr class='infos'>
				<td style="padding-left: 2%;"><?php echo $abm['adr_mail'];?></td>
				<td><?php echo $abm['libelle_service'];?></td>
				<td><?php echo $abm['jours'];?></td>
				<td><?php echo $abm['heure'];?></td>
				<td align="center"><?php echo $abm['date_ab'];?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
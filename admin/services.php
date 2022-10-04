<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	if (empty($_SESSION['num'])) {
		header("Location: login.php");
	}
	/*SERVICES*/
	$reqServ = $pdo->prepare("SELECT * FROM `services`");
	$reqServ->execute();
	$nbServ = $reqServ->rowCount();
	$listeServ = $reqServ->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Services</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include 'menu.php';?>
	<div class="inform">
		<div class="leblock">
			<p>Nombre de services: <i class="nb"><?php echo $nbServ;?></i></p>
		</div>
	</div>
	<div class="lesclasses">
		<h2>Liste des serivces</h2>
		<table class="tble" cellpadding="0" cellspacing="0" border="0" id="t1"> 
			<tr class="entete">
				<td style="padding-left: 2%;">Libellé</td>
				<td>Jours</td>
				<td>Heures</td>
				<td colspan="2" align="center">Opérations</td>
			</tr>
			<?php foreach ($listeServ as $serv) {?>
			<tr class='infos'>
				<td style="padding-left: 2%;"><?php echo $serv['libelle_service'];?></td>
				<td><?php echo $serv['jours'];?></td>
				<td><?php echo $serv['heure'];?></td>
				<td><a href="index.php?update&id=<?php echo $serv['num_service'];?>" class="update">Modifier</a></td>
				<td><a href="supp_s.php?id=<?php echo $serv['num_service'];?>" class="suppS">Supprimer</a></</td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
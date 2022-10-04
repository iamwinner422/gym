<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	if (empty($_SESSION['num'])) {
		header("Location: login.php");
	}
	/*UTILISATEURS*/
	$reqUser = $pdo->prepare("SELECT * FROM `utilisateurs`");
	$reqUser->execute();
	$nbUser = $reqUser->rowCount();
	$listeUser = $reqUser->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Utilisateurs</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include 'menu.php';?>
	<div class="inform">
		<div class="leblock">
			<p>Nombre d'inscrits: <i class="nb"><?php echo $nbUser;?></i></p>
		</div>
	</div>
	<div class="lesclasses">
		<h2>Liste des utilisateurs</h2>
		<table class="tble" cellpadding="0" cellspacing="0" border="0" id="t2"> 
			<tr class="entete">
				<td style="padding-left: 2%;">Nom</td>
				<td>Prénoms</td>
				<td>Adresse E-mail</td>
				<td align="center">Opérations</td>
			</tr>
			<?php foreach ($listeUser as $user) {?>
			<tr class='infos'>
				<td style="padding-left: 2%;"><?php echo $user['nom_user'];?></td>
				<td><?php echo $user['prenoms_user'];?></td>
				<td><?php echo $user['adr_mail'];?></td>
				<td align="center"><a href="supp_u.php?id=<?php echo $user['num_user'];?>" class="suppS">Supprimer</a></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
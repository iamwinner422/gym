<?php
session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	if (empty($_SESSION['num'])) {
		header("Location: index.php#connexion");
		exit();
	}
	/*SERVICES*/
	$id = intval($_SESSION['num']);
	$requete = $pdo->prepare("SELECT num_ab, libelle_service, jours, heure, date_ab FROM  `services` S, `abonnements` A, `utilisateurs` U WHERE `S`.num_service = `A`.num_service AND `A`.num_user = `U`.num_user AND `U`.num_user = ? ORDER BY `A`.num_ab DESC");
	$requete->execute(array($id));
	$listeAbonnement = $requete->fetchAll();
	$nbAb = $requete->rowCount();
	if ($nbAb == 0) {
		$msg = "Aucun abonnement disponible.";
	}
	$prenoms = $_SESSION['prenoms'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mon compte</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
	<?php include 'menu1.php';?>
	<div class="infos-ab">
		<div class="rond">
			<p class="chiffres"><?php echo $nbAb;?></p>
		</div>
	</div>
	<div class="affichage">
		<p align="center"><img src="img/day_off_127px.png" alt="Plannig" id="img"></p>
		<?php
			if (!isset($msg)) {
			foreach ($listeAbonnement as $ab) {
		?>
		<div class="ligne"><a href="desabonner.php?id=<?php echo $ab['num_ab'];?>" class="supp">Se désabonner</a><span><b><?php echo $ab['libelle_service'];?></b>&nbsp;&nbsp;&nbsp;<?php echo $ab['jours'];?>&nbsp;de &nbsp;<?php echo $ab['heure'];?>;&nbsp;&nbsp;&nbsp;Ajouté le <?php echo $ab['date_ab'];?></span></div>
		
		<?php }}else{
			echo "<p id='msg'>".$msg."</p>";
		}?>
	</div>
	<style type="text/css">
		#msg{
			font-size: 20px;
			text-align: center;
			color: #DE5E60;
			font-weight: bolder;
			font-family: 'Open Sans Light';
		}
	</style>
</body>
</html>
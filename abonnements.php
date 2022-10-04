<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	/*SERVICES*/
	$reqSer = $pdo->prepare("SELECT * FROM `services`");
	$reqSer->execute();
	$listeSer = $reqSer->fetchAll();
	if (empty($_SESSION['num'])) {
		header("Location: index.php#connexion");
		exit();
	}
	/*ABONNEMENT DE L'UTILISATEUR*/
	$num_user = intval($_SESSION['num']);
	$reqAbonnement = $pdo->prepare("SELECT * FROM `abonnements` WHERE `num_user` = ?");
	$reqAbonnement->execute(array($num_user));
	$nbAb = $reqAbonnement->rowCount();
	/*AJOUT DES ID DANS LE TABLEAU*/
	$tabId = array();
	foreach ($listeSer as $key) {
		array_push($tabId, $key['num_service']);
	}

	/*AJOUT DES ABONNEMENTS*/
	if (isset($_GET['id'])){
		$id= intval($_GET['id']);
		if (in_array($id, $tabId)) {
			$rqAjout = $pdo->prepare("SELECT * FROM `abonnements` WHERE `num_user` = ? AND `num_service` = ?");
			$rqAjout->execute(array($num_user, $id));
			$existe = $rqAjout->rowCount();
			if ($existe == 1) {
				echo "<script>alert('Vous êtes déjà abonné à ce service!');</script>";
			}else{
				$date = date("d/m/Y");
				$reqInsert = $pdo->prepare("INSERT INTO `abonnements` VALUES(null, ?, ?, ?)");
				$done = $reqInsert->execute(array($num_user, $id, $date));
				if ($done) {
					echo "<script>alert('L\'abonnement à été ajouté!');</script>";
					header("Location: moncompte.php");
					exit();
				}else{
					echo "<script>alert('Erreur lors de l\'ajout!');</script>";
				}
			}
		}else{
			echo "<script>document.location.replace('abonnements.php');</script>";
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Abonnements</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
	<?php include 'menu1.php'; ?>
	<div class="infos-ab">
		<div class="rond">
			<p class="chiffres"><?php echo $nbAb;?></p>
		</div>
	</div>
	<div class="corpsab" align="center">
		<h2>Veuillez ajouter des services à votre compte</h2>
		<?php
			foreach ($listeSer as $serv) {
				echo '
					<div class="block">
						<div class="content">
							<img src="'.$serv['image'].'" alt="'.$serv['libelle_service'].'" title="'.$serv['libelle_service'].'" class="img">
							<p class="comment">'.$serv['libelle_service'].'</p>
							<a href="abonnements.php?add&id='.$serv['num_service'].'" class="add">Ajouter</a>
						</div>

					</div>
				';
			}
		?>
	</div>
</body>
</html>
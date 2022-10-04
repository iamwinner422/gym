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

	/*SERVICES*/
	$reqServ = $pdo->prepare("SELECT * FROM `services`");
	$reqServ->execute();
	$nbServ = $reqServ->rowCount();
	$listeSer = $reqServ->fetchAll();
	$tabId = array();
	foreach ($listeSer as $key) {
		array_push($tabId, $key['num_service']);
	}

	/*MESSAGES*/
	$reqMsg = $pdo->prepare("SELECT * FROM `messages`");
	$reqMsg->execute();
	$nbMsg = $reqMsg->rowCount();

	/*ABONNEMENT*/
	$reqAbm = $pdo->prepare("SELECT num_ab, adr_mail, libelle_service, jours, heure, date_ab FROM  `services` S, `abonnements` A, `utilisateurs` U WHERE `S`.num_service = `A`.num_service AND `A`.num_user = `U`.num_user");
	$reqAbm->execute();
	$nbAbm = $reqAbm->rowCount();

	/*FORMULAIRE D'AJOUT*/
	if (isset($_POST['ajoutServ'])) {
		$libelle = htmlspecialchars($_POST['libelle']);
		$jours = htmlspecialchars($_POST['jours']);
		$heure = htmlspecialchars($_POST['heure']);
		if (!empty($_POST['libelle']) AND !empty($_POST['jours']) AND !empty($_POST['heure'])) {
			if (!is_numeric($jours) AND !is_numeric($libelle)) {
				/*TRAITEMENT DE L'IMAGE*/
				$extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
					if (isset($_FILES['img']) AND $_FILES['img']['error'] == 0) {
						$infoImage = pathinfo($_FILES['img']['name']);
						$extensionImage = $infoImage['extension'];
						if (in_array($extensionImage, $extensions_autorisees)){
                        //RECUPERATION DES CHEMINS
							$pathDestination = '../img/'.$_FILES['img']['name'];
							$pathTmp = $_FILES['img']['tmp_name'];
							if(move_uploaded_file($pathTmp, $pathDestination)){
                            //INSERTION DANS LA BASE
								$reqInsert = $pdo->prepare("INSERT INTO `services` VALUES(null, ?,?,?,?)");
								$done = $reqInsert->execute(array($libelle, $jours, $heure, $pathDestination));
								if ($done) {
									header("Location: services.php");
									exit();
								}else{
									$erreur = "Erreur lors de l'ajout.";
								}
							}else{
								$erreur = "Erreur lors de l'envoi.";
							}
						}else{
							$erreur = "Certains fichiers ne sont pas des images...";
						}

					}else{
						$erreur = "Erreur!";
					}
			}else{
				$erreur = "Les valeurs de certains champs sont incorrect!";
			}
		}else{
			$erreur = "Veuilez remplir tous les champs!";
		}
	}


	/*METHHODE GET*/
	if (isset($_GET['id']) AND is_numeric($_GET['id'])) {
		$id = intval($_GET['id']);
		if (in_array($id, $tabId)) {
			/*SELECTION DES INFORMATIONS DU SERVICES*/
			$reqServ2 = $pdo->prepare("SELECT * FROM `services` WHERE `num_service` = ?");
			$reqServ2->execute(array($id));
			$infoServ = $reqServ2->fetch();

			$libelleM = $infoServ['libelle_service'];
			$joursM = $infoServ['jours'];
			$heureM = $infoServ['heure'];
		}else{
			header("Location: services.php");
		}
	}
	/*TRAITEMENT DE LA MODIFICATION*/
	if (isset($_POST['modifierServ'])) {
		$libelleM = htmlspecialchars($_POST['libelleM']);
		$joursM = htmlspecialchars($_POST['joursM']);
		$heureM = htmlspecialchars($_POST['heureM']);
		if (!empty($_POST['libelleM']) AND !empty($_POST['joursM']) AND !empty($_POST['heureM'])) {
			if (!is_numeric($joursM) AND !is_numeric($libelleM)) {
				/*TRAITEMENT DE L'IMAGE*/
				$extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
				if (isset($_FILES['imgM']) AND $_FILES['imgM']['error'] == 0) {
					$infoImageM = pathinfo($_FILES['imgM']['name']);
					$extensionImageM = $infoImageM['extension'];
					if (in_array($extensionImageM, $extensions_autorisees)){
                        //RECUPERATION DES CHEMINS
						$pathDestinationM = '../img/'.$_FILES['imgM']['name'];
						$pathTmpM = $_FILES['imgM']['tmp_name'];
						if(move_uploaded_file($pathTmpM, $pathDestinationM)){
                            //INSERTION DANS LA BASE
							$reqInsert = $pdo->prepare("UPDATE `services` SET `libelle_service`= ?, `jours`=?, `heure`=?, `image` = ? WHERE `num_service`= ?");
							$done = $reqInsert->execute(array($libelleM, $joursM, $heureM, $pathDestinationM, $id));
							if ($done) {
								header("Location: services.php");
								exit();
							}else{
								$erreurM = "Erreur lors de la modification.";
							}
						}else{
							$erreurM = "Erreur lors de l'envoi.";
						}
					}else{
						$erreurM = "Certains fichiers ne sont pas des images...";
					}

				}else{
					$erreurM = "Erreur!";
				}
			}else{
				$erreurM = "Les valeurs de certains champs sont incorrect!";
			}
		}else{
			$erreurM = "Veuilez remplir tous les champs!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include 'menu.php';?>
	<div class="inform">
		<div class="leblock">
			<p>Nombre d'inscrits: <i class="nb"><?php echo $nbUser;?></i></p>
		</div>
		<div class="leblock">
			<p>Nombre de services: <i class="nb"><?php echo $nbServ;?></i></p>
		</div>
		<div class="leblock">
			<p>Nombre de méssages: <i class="nb"><?php echo $nbMsg;?></i></p>
		</div>
		<div class="leblock">
			<p>Nombre d'abonnements: <i class="nb"><?php echo $nbAbm;?></i></p>
		</div>
	</div>
	<center>
	<div class="corps-ajout">
		<div class="align">
			<h3>Ajout d'un service</h3>
			<form method="POST" id="ajout-service" action="" enctype="multipart/form-data">
				<div>
					<input type="text" name="libelle" required class="inputS" value="<?php if(isset($libelle)){echo $libelle;}?>" placeholder="Libellé">
				</div>
				<div>
					<input type="text" name="jours" required class="inputS" placeholder="Fréquence de jours" value="<?php if(isset($jours)){echo $jours;}?>">
				</div>
				<div>
					<input type="text" name="heure" required class="inputS" placeholder="Fréquence d'heures" value="<?php if(isset($heure)){echo $heure;}?>">
				</div>
				<div>
					<input type="file" name="img" required class="inputS" accept="image/*">
				</div>
				<div>
					<input type="submit" name="ajoutServ" value="Ajouter" class="submitS">
				</div>
				<?php
	 				if(isset($erreur)){
						echo '<p style="color:red;" align="center" >'.$erreur.'</p>';
					}
	 			?>
			</form>
		</div>
		<div class="align">
			<h3>Modification d'un service</h3>
			<form method="POST" id="ajout-service" action="" enctype="multipart/form-data">
				<div>
					<input type="text" name="libelleM" required class="inputS" value="<?php if(isset($libelleM)){echo $libelleM;}?>" placeholder="Libellé">
				</div>
				<div>
					<input type="text" name="joursM" required class="inputS" placeholder="Fréquence de jours" value="<?php if(isset($joursM)){echo $joursM;}?>">
				</div>
				<div>
					<input type="text" name="heureM" required class="inputS" placeholder="Fréquence d'heures" value="<?php if(isset($heureM)){echo $heureM;}?>">
				</div>
				<div>
					<input type="file" name="imgM" required class="inputS" accept="image/*">
				</div>
				<div>
					<input type="submit" name="modifierServ" value="Mettre à jour" class="submitS">
				</div>
			</form>
			<?php
	 			if(isset($erreurM)){
						echo '<p style="color:red;" align="center" >'.$erreurM.'</p>';
				}
	 		?>
		</div>
	</div>
</center>
</body>
</html>
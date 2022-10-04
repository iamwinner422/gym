<?php
	session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$nom = $_SESSION['nom'];
	$prenoms = $_SESSION['prenoms'];
	$mail = $_SESSION['mail'];
	$id = $_SESSION['num'];
	/*TRAITEMENT DU FORMULAIRE*/
	if (isset($_POST['inscription'])) {
		$prenoms = htmlspecialchars($_POST['pnoms']);
		$nom = htmlspecialchars($_POST['nom']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = sha1($_POST['pass']);
		$password2 = sha1($_POST['pass2']);

		if (!empty($_POST['pnoms']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['pass']) AND !empty($_POST['pass2'])) {
			if( filter_var($mail, FILTER_VALIDATE_EMAIL)){
					if ($password == $password2){
						$rInsert = $pdo->prepare("UPDATE `utilisateurs` SET `nom_user`=?,`prenoms_user`=?,`adr_mail`=?,`password_user`=? WHERE `num_user`=?");
						$done = $rInsert->execute(array($nom, $prenoms, $mail, $password, $id));
						if ($done) {
							$msg = "Votre compte a été bien crée!";
							$_SESSION['nom'] = $nom;
							$_SESSION['pnoms'] = $prenoms;
							$_SESSION['mail'] = $mail;
							header("Location: moncompte.php");
							exit();
						}else{
							$erreur = "Erreur lors de la modification du compte!";
						}   

					}else{
						$erreur = "Les mots de passes ne corrrespondent pas!";
					}
			}else{
				$erreur= "Votre adresse e-mail n'est pas valide!";
			}
		}else{
			$erreur = "Veuillez remplir tous les champs!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
	<?php include 'menu1.php';?>
	<div id="corps" align="center">
		<h2>Edition du profil</h2>
		<form method="POST" action="" id="form-insc">
			<div>
				<input type="text" name="nom" class="input" required="" value="<?php if(isset($nom)){echo $nom;}?>" placeholder="Entrez votre nom">
			</div>
			<div>
				<input type="text" name="pnoms" class="input" required="" value="<?php if(isset($prenoms)){echo $prenoms;}?>" placeholder="Entrez votre prénoms">
			</div>
			<div>
				<input type="email" name="mail" class="input" required="" value="<?php if(isset($mail)){echo $mail;}?>" placeholder="Entrez votre E-mail"/>
			</div>
			<div>
				<input type="password" name="pass" class="input" required="" placeholder="Entrez votre mot de passe">
			</div>
			<div>
				<input type="password" name="pass2" class="input" required="" placeholder="Confirmer votre mot de passe" id="">
			</div>
			<div>
				<input type="submit" name="inscription" class="submit" value="Mettre à jour">
			</div>
		</form>
	</div>
	<?php
		if(isset($erreur)){
			echo '<p style="color:red;" align="center" >'.$erreur.'</p>';
		}
		?>
</body>
</html>
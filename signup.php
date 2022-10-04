<?php
 session_start();
 $pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); 


	/*TRAITEMENT DU FORMULAIRE*/
	if (isset($_POST['inscription'])) {
		$prenoms = htmlspecialchars($_POST['pnoms']);
		$nom = htmlspecialchars($_POST['nom']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = sha1($_POST['pass']);
		$password2 = sha1($_POST['pass2']);

		if (!empty($_POST['pnoms']) AND !empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['pass']) AND !empty($_POST['pass2'])) {
			if( filter_var($mail, FILTER_VALIDATE_EMAIL)){
				/*VERIFICATION DE L'EXISTANCE DE L'ADRESSE E-MAIL */
				$requeteMail = $pdo->prepare("SELECT * FROM utilisateurs WHERE adr_mail = ?");
				$requeteMail->execute(array($mail));
				$mailExiste = $requeteMail->rowCount();
				if ($mailExiste == 0) {
					/*COMPARAISON DES MOTS DE PASSES*/
					if ($password == $password2){
						$rInsert = $pdo->prepare("INSERT INTO `utilisateurs` VALUES (null, ?, ?, ?, ?)");
						$done = $rInsert->execute(array($nom, $prenoms, $mail, $password));
						if ($done) {
							$msg = "Votre compte a été bien crée!";
							$_SESSION['nom'] = $nom;
							$_SESSION['pnoms'] = $prenoms;
							$_SESSION['mail'] = $mail;
							header("Location: moncompte.php");
							exit();
						}else{
							$erreur = "Erreur lors de la création du compte!";
						}   

					}else{
						$erreur = "Les mots de passes ne corrrespondent pas!";
					}
				}else{
					$erreur = "L'adresse e-mail est déjà utilisée!";
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
	<title>Inscription</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<div id="corps" align="center">
		<h2>Inscription</h2>
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
				<input type="submit" name="inscription" class="submit" value="S'incrire">
			</div>
		</form>
	</div>
	<?php
		if(isset($erreur)){
			echo '<p style="color:red;" align="center" >'.$erreur.'</p>';
		}
		if(isset($msg)){
			echo '<p style="color:green;" align="center" >'.$msg.'</p>';
		}
		?>
	<?php include 'footer.php'; ?>
</body>
</html>
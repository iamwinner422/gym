<?php
session_start();
$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Le titre de la page</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<h1>SADDAT GYM CENTER</h1>
	<h2 id="title">Page d'administration</h2>
	<div id="connexion" align="center">
		<h2>Connectez-Vous</h2>
		<form method="POST" action="" id="form-connexion">
			<div>
				<input type="text" name="e-mail" placeholder="Nom d'utilisateur" class="input" required />
			</div>
			<div>
				<input type="password" name="pass" placeholder="Mot de passe" class="input" required id="pass" />
			</div>
			<div>
				<input type="submit" name="connexion" value="connexion" class="submit">
			</div>
		</form>
	</div>
	<style type="text/css">
		#title{
			text-align: center;
			font-size: 35px;
			font-family: 'Open Sans Light';
			font-weight: lighter;
			color:#DE5E60;
		}
		h1{
			text-align: center;
			font-size: 45px;
			font-family: 'Open Sans Light';
			font-weight: lighter;
			padding-top: 5%;
			color: white;
		}
	</style>
	<?php
	if (isset($_POST['connexion'])) {

    $identification = htmlspecialchars($_POST['e-mail']);//VARIABLE UNIQUE D'IDENTIFICATION(E-MAIL ET NUMERO)
    $password = htmlspecialchars($_POST['pass']);

    if (!empty($identification) AND !empty($password)) {

    	$requeteUser = $pdo->prepare("SELECT * FROM admin where nom_admin = ? AND pass_admin = ?");/*RECHERCHE DANS LA BASE*/
    	$requeteUser->execute(array($identification, $password));
    	$userExiste = $requeteUser->rowCount();

    	if ($userExiste == 1) {
    		$userInfo = $requeteUser->fetch();
    		$_SESSION['num'] = $userInfo['num_admin'];
    		$_SESSION['nom'] = $userInfo['nom_admin'];
    		$_SESSION['pass'] = $userInfo['pass_admin'];
    		echo "<script>document.location.replace('index.php')</script>";
    	}
    	else{
    		$erreur = "Adresse e-mail ou le mot de passe est incorrect";
    	}

    }else{
    	$erreur = "Veuillez remplir tous les champs!";
    }
}
?>
<?php
if(isset($erreur)){
	echo '<p style="color:red;" align="center" >'.$erreur.'</p>';
}
?>
</body>
</html>
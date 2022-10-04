<?php
session_start();
	$pdo = new PDO('mysql:host=localhost; dbname=gym', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

		if (isset($_POST['envoyer'])) {
    /*CHAMPS VIDES*/
        if (empty($_POST['e-mail']) AND empty($_POST['sujet']) AND empty($_POST['msg'])) {
            echo"<script>alert('Veuillez remplir tous les champs!');</script";                     
        }else{
            $mail = htmlspecialchars($_POST['e-mail']);
            $objet = htmlspecialchars($_POST['sujet']);
            $message = htmlspecialchars($_POST['msg']);

            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            	/*requette*/
            	$laRequete = $pdo->prepare("INSERT INTO `messages` VALUES(null,?,?,?)");
            	$done = $laRequete->execute(array($mail, $objet, $message));
            	if ($done) {
            		echo"<script>alert('Votre méssage a été bien envoyé. Nous vous répondrons dans les plus brefs délais.');</script>";
            		/*affectation des valeurs nulles*/
            		$mail = " ";
            		$objet = " ";
            		$message = " ";
            	}else{
            		echo"<script>alert('Erreur lors de l'envoi du méssage!');</script";
            	}
            }else{
            	echo"<script>alert('L\'adresse e-mail saisie n\'est pas valide!');</script";
            }
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>SADDAT GYM CENTER</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div id="home">
		<div class="contenaire">
			<h2>SADDAT GYM CENTER</h2>
			<p>La remise en forme pour tous !</p>
		</div>
	</div>
		<!-- DIV DE L'ACCUEIL -->
		<div id="commentaire">
			<p>
				A remise en forme pour tous et dans un bon esprit, à la factory, pas de miroir au mur! Notre centre est dédié à la remise en forme en toute convivialité, sans le soucis du regard des autres. Chaque adhérent a ses propres attentes, que ce soit de l'amincissement, du défoulement, de apaisement ou encore de l'entraînement sportif.
				<br>
				<br/>
				<br/>
				Les dernières tendances septembre 2020 : Fit jump et R'Lace

				Zumba, Cardio Work, R’Lace, Cardio Attack, Abdo-fessiers, Fit Jump, Body barre, stretching, Pilates!

				Le tout avec des profs en chaire et en os! Tous nos profs sont là pour vous entrainer avec eux, que vous cherchiez à perdre du poids, à vous défouler ou que vous soyez déjà addict aux cours collectifs.

				A La Factory, les cours sont choisis dans les dernières tendances ; cette année, le Fit jump et R’Lace sont les nouveautés qu’il faut découvrir!

				<br/>A vos planning!
			</p>
		</div>
	<!-- DIV DES SERVICES -->
	<div id="services">
		<h2>Nos Services</h2>
		<div class="serv">
			<!-- TAPIS -->
			<h3 class="stitre">Les Tapis</h3>
			<p>
				Que vous vouliez courir ou marcher, nos 12 tapis Incline trainer vous donnerons accès à des programmes simples et efficaces. Avec une inclinaison variant de -3 à 30% vos séances de marche prendront des allures de randonnées en montagne vous garantissant de brûler jusqu'à 7 fois plus de calories grasses qu'en faisant de la course à pieds! Et si courir est votre élément, vous pourrez travailler vos sprints jusqu'à 20km/h ou encore travailler la régularité de votre foulée, le tout avec la douceur de l'amorti propre au tapis de course qui préserve vos articulations des chocs que vous encaissez lorsque vous courrez sur du béton.
			</p>
		</div>
		<br>
		<!-- VELOS -->
		<div class="serv">
			<h3 class="stitre">Les Vélos</h3>
			<p>
				Vélo traditionnel pour les inconditionnels de la route et vélos semi allongés pour votre plus grand confort, vous permettent d'effectuer un excellent travail cardiovasculaire pour la santé de vos artères!
			</p>
		</div>
		<br>
		<!-- EPILETIQUE -->
		<div class="serv">
			<h3 class="stitre">L'elliptique</h3>
			<p>
				Combine un travail du haut et du bas du corps. Excellent travail pour les fessiers, l'elliptique est à lui seul un entraînement complet et extrêmement efficace!
			</p>
		</div>
		<br>
		<!-- PILATES -->
		<div class="serv">
			<h3 class="stitre">Renforcement Musculaire</h3>
			<p>
			<h4 class="sstitre"> Machines Guidées </h4>
			Les machines de renforcement musculaire guidées vous permettent de travailler en toute sécurité quelque soit votre niveau de pratique. Le geste est imposé par la machine ce qui vous protège de tout faut mouvement . Nos 12 postes vous attendent pour un travail complet de tous les groupes musculaires.
			<br/>
			<h4 class="sstitre">Machines 3D</h4>
			Les mouvements libres en opposition aux mouvements guidés vous laissent toute liberté d'action vous imposant de guider par vous même vos gestes. Vous effectuez ainsi un entraînement dit "fonctionnel" ou toutes les fibres stabilisatrices sont sollicitées renforçant ainsi l'équilibre musculaire de votre corps.
			Cet entraînement de la même façon s'adresse à tous publics..
			</p>
		</div>
		<div class="serv">
			<h3 class="stitre">Les Pilates</h3>
			<p>
				RESPIRATION - CONTROLE - CONCENTRATION<br/>
				La méthode Pilates est une méthode de renforcement musculaire douce mais intense. Le principe étant de ré-équilibrer les muscles de notre corps en travaillant dʼavantages les muscles profonds et en soulageant ceux dont on se sert le plus. Cette méthode vise à vous faire prendre conscience de votre corps et à soulager les petits traumatismes cumulés tout au long dʼune journée dus à de mauvaises habitudes induits par le sédentarisme, les déplacements en voitures, le portage de charges plus ou moins lourdes... LES BIENFAITS Au quotidien, les bienfaits de Pilates sont réels : Mieux-être, soulagements du dos, meilleure posture, raffermissement . Une séance de Pilates soulage également du stress et des tensions éventuelles liées au quotidien. Les bienfaits du Pilates sont nombreux et reconnus. Les cours sont essentiellement basés sur le contrôle et la respiration. Pratiquer Pilates nécessite une réelle concentration afin de prendre conscience des muscles de son corps.<br>
				Pourquoi ça marche...<br>
				<br/>
				Ne vous êtes-vous jamais étonnée de n'avoir pas un ventre plat alors que vous faisiez des abdominaux ?
				En fait, vous ne travailliez pas assez profondément et efficacement vos muscles. Avec cette gym, vous prenez davantage conscience de votre corps, pour en tirer le meilleur profit. L'enseignement de la méthode Pilates se fonde sur des mouvements élémentaires, faciles à apprendre et ne présentant pas le moindre danger pour celui qui la pratique. Elle corrige les asymétries et faiblesses chroniques pour restaurer un équilibre corporel et prévenir les nouvelles blessures.
				Comment ça ce déroule...
				<br>
				SUIVI<br>
				Afin de bénéficier dʼun suivi précis les cours n'excèdent pas 10 personnes. Les cours de Pilates s'adaptent à tous les niveaux. Que vous soyez novices ou confirmés, vous trouverez à chaque fois une réponse à vos attentes.
			</p>
		</div>
	</div>
	<div id="About">
		<h2>A propos de nous</h2>
	</div>
	<div id="Contact" align="center">
		<h2>Contactez Nous</h2>
		<form id="form-contact" method="POST" action="">
			<div>
				<input type="email" name="e-mail" placeholder="Adresse E-mail" class="input" required />
			</div>
			<div>
				<input type="text" name="sujet" placeholder="Objet" class="input" required />
			</div>
			<div>
				<textarea cols="41" rows="4" name="msg" class="msg" placeholder="Ecrivez votre message.." required></textarea>
			</div>
			<div>
				<input type="submit" name="envoyer" value="envoyer" class="submit">
			</div>
		</form>
	</div>
	 <div id="connexion" align="center">
	 	<h2>Connectez-Vous</h2>
	 	<form method="POST" action="" id="form-connexion">
	 		<div>
				<input type="email" name="e-mail" placeholder="Adresse E-mail" class="input" required />
			</div>
			<div>
				<input type="password" name="pass" placeholder="Mot de passe" class="input" required id="pass" />
			</div>
			<div>
				<input type="submit" name="connexion" value="connexion" class="submit">
				<p class="phrase">Pas encore inscrit? <a href="signup.php">Inscrivez-vous</a></p>
			</div>
	 	</form>
	 </div>
	 <?php
	 	if (isset($_POST['connexion'])) {

        $identification = htmlspecialchars($_POST['e-mail']);//VARIABLE UNIQUE D'IDENTIFICATION(E-MAIL ET NUMERO)
        $password = sha1($_POST['pass']);

        if (!empty($identification) AND !empty($password)) {

        	$requeteUser = $pdo->prepare("SELECT * FROM utilisateurs where adr_mail = ? AND password_user = ?");/*RECHERCHE DANS LA BASE*/
        	$requeteUser->execute(array($identification, $password));
        	$userExiste = $requeteUser->rowCount();

        	if ($userExiste == 1) {
        		$userInfo = $requeteUser->fetch();
        		$_SESSION['num'] = $userInfo['num_user'];
                $_SESSION['prenoms'] = $userInfo['prenoms_user'];
                $_SESSION['nom'] = $userInfo['nom_user'];
                $_SESSION['mail'] = $userInfo['adr_mail'];
                echo "<script>document.location.replace('moncompte.php')</script>";
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
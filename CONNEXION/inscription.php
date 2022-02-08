<?php
include('../INCLUDE/authentification.php');
if(isset($_POST["register"])){	
	if(!empty($_POST["e-mail"]) && !empty($_POST["confirm-e-mail"]) && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["date"]) && !empty($_POST["adresse"]) && !empty($_POST["tel"]) && !empty($_POST["pass"]) && !empty($_POST["confirm-pass"])) {
		if ($_POST["pass"] == $_POST["confirm-pass"] && $_POST["e-mail"] == $_POST["confirm-e-mail"]) {
			$req = $bdd->prepare("SELECT * FROM utilisateur WHERE mail=?");
			$req->execute([$_POST["e-mail"]]); 
			if (!($req->fetch())) {
				$psswd = password_hash($_POST["pass"], PASSWORD_DEFAULT);
				$req = $bdd->prepare("INSERT INTO utilisateur (nom, prenom, date_naissance, adresse, tel, mail, password, inscription) VALUES ('" . $_POST["nom"] . "', '" . $_POST["prenom"] . "', '" . $_POST["date"] . "', '" . $_POST["adresse"] . "', " . $_POST["tel"] . ", '" . $_POST["e-mail"] . "', '$psswd', NOW())");
				$req->execute();
				header('Location: connexion');
				exit();
			} 
			else {
				echo '<div class="error__msg"><p>E-mail déjà utilisé.</p></div>';
			}
		} 
		else {
			echo '<div class="error__msg"><p>E-mail ou mot de passe incorrects.</p></div>';
		}
	} 
	else {
		echo '<div class="error__msg"><p>Champs incorrects.</p></div>';
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>E-Boutique</title>
		<link rel="icon" href="IMG/eshop.png" />
		<link rel="stylesheet" href="../CONNEXION/style.css">
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	</head>
	<body>
		<nav>
			<img src="IMG/eshop.png" style="display: block; margin-left: auto; margin-right: auto; margin-top: 1%; width: 10%;">
		</nav>
		<form action="inscription" method="post" id="Form-Inscription">
			<h1>Inscrivez-vous</h1>
			<p>Vous avez déjà un compte ? <a href="connexion">Se connecter</a></p>
			<label for="e-mail">
				<input type="e-mail" name="e-mail" id="e-mail" placeholder="E-mail" required>
				<input type="e-mail" name="confirm-e-mail" id="confirm-e-mail" placeholder="Confirmer votre e-mail" required> 
			</label>
			<label for="information">
				<input type="text" name="nom" id="nom" placeholder="Nom" required>
				<input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
				<input type="date" name="date" id="date" placeholder="Date de naissance" required>
				<input type="text" name="adresse" id="adresse" placeholder="Rue, adresse, code postal" required>
				<input type="tel" name="tel" id="tel" placeholder="Téléphone" required> 
			</label>
			<label for="password">
				<input type="password" name="pass" id="pass" placeholder="Mot de passe" required> 
				<input type="password" name="confirm-pass" id="confirm-pass" placeholder="Confirmer votre mot de passe" required> 
				<div class="eye__Pass" id="eye">
					<i class="far fa-eye"></i>
				</div>
				<div class="eye__Pass" id="eye-slash">
					<i class="far fa-eye-slash"></i>
				</div>
				
			</label>
			<input type="submit" name="register" value="S'inscrire" id="Submit-Register">
		</form>
		<script src="https://kit.fontawesome.com/207352b49e.js" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="../INCLUDE/main.js"></script>
	</body>
</html>
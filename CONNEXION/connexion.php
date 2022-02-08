<?php
include('../INCLUDE/authentification.php');
if(isset($_POST["connexion"])){	
	$errorLogin = '<div class="error__msg"><p>Champs incorrects.</p></div>';
	if(!empty($_POST["login"]) && !empty($_POST["pass"])){
		$req = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ?');
		$req->execute(array($_POST["login"]));
		$data = $req->fetch();
		if ($data["mail"] == $_POST["login"] && password_verify($_POST["pass"], $data["password"])) {
			if ($data["role"] == "Admin") {
				session_start();
				$_SESSION["admin"] = $data["mail"];
				header('Location: ../');
				exit();
			} 
			else {
				session_start();
				$_SESSION['user'] = $data["mail"];
				header('Location: ../');
				exit();
			}
		} 
		else {
			echo $errorLogin;
		}
	} 
	elseif (empty($_POST["login"]) || empty($_POST["pass"])) {
		echo $errorLogin;
	}
}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>E-Boutique</title>
		<link rel="icon" href="IMG/eshop.png"/>
		<link rel="stylesheet" href="../CONNEXION/style.css">
	</head>
	<body>
		<nav>
			<img src="IMG/eshop.png" style="display: block; margin-left: auto; margin-right: auto; margin-top: 1%; width: 10%;">
		</nav>
		<form action="connexion" method="post" id="Form-Connexion">
			<h1>Identifiez-vous</h1>
			<p>Vous n'avez pas de compte ? <a href="inscription">S'inscrire</a></p>
			<label for="login">
				<input type="text" name="login" id="login" placeholder="E-mail" required> 
			</label>
			<label for="password">
				<input type="password" name="pass" id="pass" placeholder="Mot de passe" required> 
				<div class="eye__Pass" id="eye">
					<i class="far fa-eye"></i>
				</div>
				<div class="eye__Pass" id="eye-slash">
					<i class="far fa-eye-slash"></i>
				</div>
				
			</label>
			<input type="submit" name="connexion" value="Connexion" id="Submit-Connexion">
		</form>
		<?php
			include('../INCLUDE/script.html');
		?>
	</body>
</html>
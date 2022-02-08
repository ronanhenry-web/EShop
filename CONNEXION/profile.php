<?php
	include('INCLUDE/authentification.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>E-Boutique</title>
		<link rel="icon" href="IMG/eshop.png"/>
		<link rel="stylesheet" href="../CONNEXION/style.css">
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	</head>
	<body>
		<form action="profile.php" method="post" id="Form-Inscription">
			<h1>Membre</h1>
			<div class="row">
				<div class="value__container">
					<p>Numéro du client</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
				<div class="value__container">
					<p>Nom</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
				<div class="value__container">
					<p>Prénom</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
				<div class="value__container">
					<p>Adresse</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
				<div class="value__container">
					<p>Numéro téléphone</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
				<div class="value__container">
					<p>E-mail</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
				<div class="value__container">
					<p>Mot de passe</p>
					<input type="password" name="idClient" value="password" disabled>
				</div>
				<div class="value__container">
					<p>Inscrit le</p>
					<input type="text" name="idClient" value="<?php echo "test";?>" disabled>
				</div>
			</div>
			<input type="submit" name="home" value="Retour à la page d'accueil" id="Submit-Home">
		</form>
		<?php
			include('INCLUDE/script.html');
		?>
	</body>
</html>
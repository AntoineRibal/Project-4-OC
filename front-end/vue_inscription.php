<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8' />
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="../V/css/style.css">
</head>
<body>

	<?php include('vue_header.php'); ?>

	<div class="blocTexte">
		<form method='post' action='c_inscription.php'>
			<label>Pseudo : </label>
			<input type="text" name="pseudo">
			<br>
			<label>Mail : </label>
			<input type="Mail" name="mail">
			<br>
			<label>Mot de passe : </label>
			<input type="password" name="mdp">
			<br>
			<label>Retapez votre mot de passe : </label>
			<input type="password" name="mdp2">
			<br>
			<input type="submit" value="En route vers l'Alaska !">
		</form>
	</div>
	
</body>
</html>
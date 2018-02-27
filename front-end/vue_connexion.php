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
		<form method='post' action='c_connexion.php'>
			<label>Pseudo : </label>
			<input type="text" name="pseudo">
			<label>Mot de passe : </label>
			<input type="password" name="mdp">
			<input type="submit" value="En route vers l'Alaska !">
			<p>Pas encore de compte ? Inscris-toi <a href="../C/c_routeur.php?section=5">ici</a></p>
		</form>
	</div>
	
</body>
</html>
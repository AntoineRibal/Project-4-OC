<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8' />
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="../V/css/style.css">
</head>
<body>
	<?php include('../V/front-end/vue_headerAdmin.php'); ?>
	<div class="blocTexteMenu">
		

		<a href="../C/c_routeur.php?section=7.1"><div class="blocMenu "><p>Nouveau</p></div></a>
		<a href="../C/c_routeur.php?section=7.2"><div class="blocMenu "><p>Chapitres</p></div></a>
		<a href="../C/c_routeur.php?section=7.3"><div class="blocMenu " 
			<?php 
			if ($moderation=='vrai') {
				echo "style='background-color: red;'";
			}
			?>
			><p>Modération</p></div></a>	
		<a href="../C/c_routeur.php?section=4"><div class="blocMenu "><p>Déconnexion</p></div></a>	
	</div>
</body>
</html>
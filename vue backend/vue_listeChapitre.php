<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8' />
	<title>Liste des chapitres</title>
	<link rel="stylesheet" type="text/css" href="../V/css/style.css">
</head>
<body>
	<?php 
		 include('../V/front-end/vue_headerAdmin.php');
 
	$verifco_user = new User;
	?>
	<div class="blocTexte">
		<h1>Liste des chapitres</h1>
		<div>
			<?php 
				//parcours
				$billets = Billet::recupAllBillets();
				while ($billet = $billets->fetch()) {
					echo "<a href='c_routeur.php?section=7.6&billet=".$billet['id']."'><p>".$billet['titre']."</p></a><p><a href='c_routeur.php?section=7.4&billet=".$billet['id']."'>Modifier</a> 
					- <a href='c_routeur.php?section=7.5&billet=" . $billet['id'] . "'>Supprimer</a></p>";
				}

			?>
		</div>
	</div>
</body>
</html>
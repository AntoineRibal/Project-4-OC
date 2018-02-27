<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8' />
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="../V/css/style.css">
</head>
<body>
	<?php 
	include('vue_headerCo.php');;  
	?>
	<div class="blocTexte">
		<h1>Liste des chapitres</h1>
		<div>
			<?php 
				$billets = Billet::recupAllBillets();
				while ($billet = $billets->fetch()) {
					echo "<a href='c_routeur.php?section=1.1&billet=".$billet['id']."'><p>".$billet['titre']."</p></a>";
				}
			?>
		</div>

	</div>
</body>
</html>
<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8' />
	<title>Accueil</title>
	<link rel="stylesheet" type="text/css" href="../V/css/style.css">
</head>
<body>
		<?php include('../V/front-end/vue_headerAdmin.php'); ?>

	<div class="blocTexte">
		<h1>Commentaires en attente de modération</h1>

		<div>
			<?php 
				while ($com = $coms->fetch()) {
					if ($com['modo'] == 'vrai') {
					echo "<p>".$com['date_ajout']." | ".$com['pseudo']." : " . $com['texte'] . "</p>" .
						"<p> <a href='c_moderation.php?section=7.3.1&idcom=" . $com['id'] . "'>ignorer</a> - 
							<a href='c_moderation.php?section=7.3.2&idcom=" . $com['id'] . "'>supprimer</a></p> ";
					}
					
				}
			?>
		</div>
	</div>
</body>
</html>
<?php 
include_once('../M/m_connexionbdd.php');
include_once('../M/m_class_modele.php');
$verif_billet = new Billet;

//Ici qu'on gère la rédaction d'un billet 
if ($_GET['section'] == '7.1.1') {

	if (isset($_POST['titre']) && isset($_POST['texte']))
	{
		if ($_POST['titre'] != '') {
			$titre = htmlspecialchars($_POST['titre']);
		}
		else{
			include_once('../V/back-end/vue_nouveau.php');
			echo '<script>alert("Veuillez entrer un titre");</script>';
			exit();
		}
		if ($_POST['texte'] != '') {
			$texte = $_POST['texte'];
		}
		else{
			include_once('../V/back-end/vue_nouveau.php');
			echo '<script>alert("Veuillez entrer du texte");</script>';
			exit();
		}


		$verif_billet->setBillet($texte);
		$verif_billet->setTitre($titre);

		$verif_billet->ecrireBillet();

		header('Location: ../C/c_routeur.php?section=7');
		exit;
	}
	else{
		include_once('../V/back-end/vue_nouveau.php');
		echo "<script>alert('Veuillez remplir tous les champs du formulaire')</script>";
	}
}
//Ici qu'on gère l'affichage d'un billet 
else if ($_GET['section'] == '7.6') {

	$billets = Billet::recupAllBillets();
	while ($billet = $billets->fetch()) {
		if ($billet['id'] == $_GET['billet']) {
			$titre = $billet['titre'];
			$contenu = $billet['texte'];
		}
	}

	include_once('../V/back-end/vue_chapitre.php');
}
//Ici qu'on gère la modification d'un billet 
else if ($_GET['section'] == '7.4') {

	$billets = Billet::recupAllBillets();
	while ($billet = $billets->fetch()) {
		if ($billet['id'] == $_GET['billet']) {
			$id = $billet['id'];
			$titre = $billet['titre'];
			$contenu = $billet['texte'];
		}
	}

	include_once('../V/back-end/vue_modifBillet.php');
}
	else if ($_GET['section'] == '7.4.1') {

		$billets = Billet::recupAllBillets();
		while ($billet = $billets->fetch()) {
			if ($billet['id'] == $_GET['Billet']) {

				/*if ($_POST['titre'] != '') {
					$titre = htmlspecialchars($_POST['titre']);
				}
				else {
					include_once('../V/back-end/vue_nouveau.php');
					echo '<script>alert("Veuillez entrer un titre");</script>';
					exit();
				}
				if ($_POST['texte'] != '') {
					$texte = $_POST['texte'];
				}
				else{
					include_once('../V/back-end/vue_nouveau.php');
					echo '<script>alert("Veuillez entrer du texte");</script>';
					exit();
				}*/
				$texte = $_POST['nvtexte'];
				$titre = htmlspecialchars($_POST['nvtitre']);
				$id = $_GET['Billet'];

				$verif_billet->setBillet($texte);
				$verif_billet->setTitre($titre);
				$verif_billet->setId($id);

				$verif_billet->modifBillet();

				header('Location: ../C/c_routeur.php?section=7.2');
				exit;



			}
		}

		include_once('../V/back-end/vue_modifBillet.php');
	}
//Ici qu'on gère la suppression d'un billet 
else if ($_GET['section'] == '7.5') {

	$billets = Billet::recupAllBillets();
	$coms = Commentaire::recupAllComments();
	while ($billet = $billets->fetch()) {
		if ($billet['id'] == $_GET['billet']) {

			while ($com = $coms->fetch()) {
				if ($_GET['billet'] == $com['id_billet']) {
					$deletecom = new Commentaire;
					$deletecom->setIdCom($com['id']);
					$deletecom->deleteCommentaire();

					
				}
			}

			$id = $_GET['billet'];
			$verif_billet->setId($id);

			$verif_billet->deleteBillet();
			header('Location: ../C/c_routeur.php?section=7.2');
		}
	}
}

//Affichage chapitre pour user co. 
else if ($_GET['section'] == '1.1') {

	$billets = Billet::recupAllBillets();
	while ($billet = $billets->fetch()) {
		if ($billet['id'] == $_GET['billet']) {
			$titre = $billet['titre'];
			$contenu = $billet['texte'];
		}
	}

}

?>
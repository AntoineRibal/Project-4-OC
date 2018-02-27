<?php 
include_once('../M/m_connexionbdd.php');
include_once('../M/m_class_modele.php');
$verif_Com = new Commentaire;

//Ici qu'on gère la rédaction d'un commentaires
if ($_GET['section'] == 'a.1') {

	if (isset($_POST['commentaire']))
	{
		$billetID = $_GET['billet'];

		if ($_POST['commentaire'] != '') {
			$commentaire = htmlspecialchars($_POST['commentaire']);
		}
		else{
				header('Location: ../C/c_routeur.php?section=1.1&billet='.$billetID);
			exit();
		}

		$verif_Com->setidBillet($billetID);
		$verif_Com->setCommentaire($commentaire);
		$verif_Com->setAuteur($_COOKIE['id']);

		$verif_Com->ecrireCommentaire();

		header('Location: ../C/c_routeur.php?section=1.1&billet='.$billetID);
		exit;
	}
	else{
		include_once('../V/back-end/vue_nouveau.php');
		echo "<script>alert('Veuillez remplir tous les champs du formulaire')</script>";
	}
}
elseif ($_GET['section'] == 'a.2') {
	$billetID = $_GET['billet'];
	$idCom = $_GET['idcom'];
	$modo = 'vrai';
	$verif_Com->setidCom($idCom);
	$verif_Com->setModo($modo);
	$verif_Com->signalerCommentaire();
	header('Location: ../C/c_routeur.php?section=1.1&billet='.$billetID);
}
else{
	include_once('../V/front-end/error404.php');
}

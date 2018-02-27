<?php 
include_once('../M/m_connexionbdd.php');
include_once('../M/m_class_modele.php');
$verif_Com = new Commentaire;

	if ($_GET['section'] == '7.3') {

		$coms = Commentaire::recupAllComments();
		include_once('../V/back-end/vue_moderation.php');
	}
	else if ($_GET['section'] == '7.3.1') {
		$idCom = $_GET['idcom'];
		$modo = 'faux';
		$verif_Com->setidCom($idCom);
		$verif_Com->setModo($modo);
		$verif_Com->designalerCommentaire();
		header('Location: ../C/c_routeur.php?section=7.3');;
	}
	else if ($_GET['section'] == '7.3.2') {
		$idCom = $_GET['idcom'];
		$verif_Com->setidCom($idCom);
		$verif_Com->deleteCommentaire();
		header('Location: ../C/c_routeur.php?section=7.3');;
	}
	else{
		include_once('../V/vue_error404.php');
	}


?>
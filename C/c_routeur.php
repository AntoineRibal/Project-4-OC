<?php 



if(!isset($_GET['section']) OR $_GET['section'] == 'index')
{
	include_once('../V/front-end/vue_accueil.php');
}
elseif ($_GET['section'] == '1') {

	include_once('../V/front-end/vue_chapitre.php');
}
elseif ($_GET['section'] == '1.1' && isset($_GET['billet'])) {
	include_once('../M/m_class_modele.php');
	include_once('c_billet.php');
	include_once('../V/front-end/vue_chapitreCo.php');
}
elseif ($_GET['section'] == '2') {
	include_once('../V/front-end/vue_connexion.php');
}
elseif ($_GET['section'] == '4') {
	include_once('../V/front-end/vue_accueil.php');
}
elseif ($_GET['section'] == '5') {
	include_once('../M/m_class_modele.php');
	include_once('../V/front-end/vue_inscription.php');
}
elseif ($_GET['section'] == '6') {
	include_once('../M/m_class_modele.php');
	include_once('../V/front-end/vue_accueil_co.php');
}
elseif ($_GET['section'] == '7') {
	include_once('../M/m_class_modele.php');
	if ($_COOKIE['pseudo'] == 'admin') {
		$moderation = '';
		$blocModo =  Commentaire::recupAllComments();
		while ($com = $blocModo->fetch()) {
			if ($com['modo'] == 'vrai') {
				$moderation = 'vrai';
			}
		}

		include_once('../V/back-end/vue_backoffice.php');
	}
	else{
		header('Location: ../index.php');
	}
	
}
	elseif ($_GET['section'] == '7.1') {

		if ($_COOKIE['pseudo'] == 'admin') {
		include_once('../V/back-end/vue_nouveau.php');
		}
		else{
		header('Location: ../index.php');
		}
	}
	elseif ($_GET['section'] == '7.2') {

		if ($_COOKIE['pseudo'] == 'admin') {
			include_once('../M/m_class_modele.php');
			include_once('../V/back-end/vue_listeChapitre.php');
		}
		else{
		header('Location: ../index.php');
		}
	}

	elseif ($_GET['section'] == '7.3') {

		if ($_COOKIE['pseudo'] == 'admin') {
			include_once('../M/m_class_modele.php');
			include_once('c_moderation.php');
		}
		else{
		header('Location: ../index.php');
		}
		
	}

	elseif ($_GET['section'] == '7.6') {
		if ($_COOKIE['pseudo'] == 'admin') {
			include_once('../M/m_class_modele.php');
			include_once('c_billet.php');
			include_once('../V/back-end/vue_chapitre.php');
		}
		else{
			header('Location: ../index.php');
		}
	}

	elseif ($_GET['section'] == '7.4' && isset($_GET['billet']) ) {
		if ($_COOKIE['pseudo'] == 'admin') {
			include_once('../M/m_class_modele.php');
			include_once('c_billet.php');
		}
		else{
			header('Location: ../index.php');
		}
	}
	elseif ($_GET['section'] == '7.5' && isset($_GET['billet']) ) {
		if ($_COOKIE['pseudo'] == 'admin') {
			include_once('../M/m_class_modele.php');
			include_once('c_billet.php');
		}
		else{
			header('Location: ../index.php');
		}
	}

else
{
	include_once('../V/vue_error404.php');
}

?>
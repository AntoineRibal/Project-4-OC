<?php 
	/* 
	Les données du formulaire d'inscription, vérifie les mots de passe identique, si le pseudo existe pas déjà et renvoie:
		- soit à la controleur avec 'section' pour gens connecté 
		- soit à la controleur ('section') avec le message d'erreur des infos manquante ou errroné. vers page inscription

		*/
		
include_once('../M/m_connexionbdd.php');
include_once('../M/m_class_modele.php');
$verif_user = new User;
	


if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && isset($_POST['mail'])) 
{
	if ($_POST['pseudo'] != '') {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true); 
	}
	else{
		
		include_once('../V/front-end/vue_inscription.php');
		echo   "<script>alert('Veuillez entrer un pseudo non utilisé')</script>";
		exit();
	}
	

	if ($_POST['mdp'] == $_POST['mdp2'] && $_POST['mdp'] != '')
	{
		$mdp = sha1($_POST['mdp']);
	}
	else
	{
		
		include_once('../V/front-end/vue_inscription.php');
		echo   "<script>alert('Veuillez entrer deux mots de passes identiques')</script>";
		exit();
	}

	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
    {
        $email = $_POST['mail'];
    }
    else
    {
    
		include_once('../V/front-end/vue_inscription.php');
		echo   "<script>alert('Veuillez entrer une adresse mail valide')</script>";
		exit();
    }
	//Verifié qu'il n'y ai pas de doublon 

	$users = User::recupAllUsers();

	while ($user = $users->fetch()) {
		if ($pseudo == $user['pseudo'] || $email == $user['mail']) 
		{
			setcookie('id', $user['id'], time() + 365*24*3600, null, null, false, true); 
			include_once('../V/front-end/vue_inscription.php');
			echo "<script>alert('Pseudo ou adresse mail déjà utiliser')</script>";
			exit();
		}
	}

	$verif_user->setPseudo($pseudo);
	$verif_user->setMail($email);
	$verif_user->setMdp($mdp);

	$verif_user->ecrireUser();
	//Tout est bon on demande l'enregistrement du nouvel utilisateur.
	
   // Method::writeUser($pseudo $email $mdp);
   // if ($_COOKIE['co'] == 'true') {
    //	echo "<script>alert('Une session est déjà en cours !')</script>";
    //	exit();
    //}
   // setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true); 
    //setcookie('co', 'true', time() + 365*24*3600, null, null, false, true); // On écrit un cookie
	header('Location: c_routeur.php?section=6');
	   
}

else{
	include_once('../V/front-end/vue_inscription.php');
	echo "<script>alert('Veuillez remplir tous les champs du formulaire')</script>";
	exit();
}




?>
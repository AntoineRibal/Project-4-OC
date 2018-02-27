<?php 
	/*Recoit les données du formulaire de connexion,

	--> Vérifie la présence dans la base de données du login 
	--> Vérification si ADMIN, si ADMIN renvoie vers backoffice. 
	--> Compare les mot de passe (hashage)
	--> Renvoi soit vers le routeur avec le 'section' correspondant à page de connexion si erreur soit au routeur qui renverra vers l'accueil des gens co. 
*/

include_once('../M/m_class_modele.php');
//$verifco_user = new User;

//$verif_connection = null;
//$verif_bdd = null;

if (isset($_POST['pseudo']) && isset($_POST['mdp'])) 
{
	if ($_POST['pseudo'] != '') {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true); 	
	}
	else{
		include_once('../V/front-end/vue_connexion.php');		
		echo '<script>alert("Veuillez entrer votre pseudo ou adresse mail")</script>';
		exit();
	}
	
	if ($_POST['mdp'] != '')
	{
		$mdp = sha1($_POST['mdp']);
	}
	else
	{
		include_once('../V/front-end/vue_connexion.php');	
		echo '<script>alert("Veuillez entrer votre mot de passe")</script>';	
		exit();	
	}


	$users = User::recupAllUsers();

	while ($user = $users->fetch()) {
		if ($pseudo == 'admin' && $user['pseudo'] == 'admin' && $mdp == $user['mdp']) 
		{
			//mdp admin : admini
			setcookie('id', $user['id'], time() + 365*24*3600, null, null, false, true); 
			header('Location: ../C/c_routeur.php?section=7');
			exit();
		}

		else if (($pseudo == $user['pseudo'] || $pseudo == $user['mail']) && $mdp == $user['mdp'])
		{
			setcookie('id', $user['id'], time() + 365*24*3600, null, null, false, true); 
			//setcookie('pseudo', $test['pseudo'], time() + 365*24*3600, null, null, false, true);
			//setcookie('co', 'true', time() + 365*24*3600, null, null, false, true); // On écrit un cookie 
			
			header('Location: ../C/c_routeur.php?section=6');
			
			exit();
			
		}
	}
	include_once('../V/front-end/vue_connexion.php');
	//header('Location: ../C/c_routeur.php?section=2');
}

else{
	include_once('../V/front-end/vue_connexion.php');
	echo '<script>alert("Veuillez remplir tous les champs du formulaire.")</script>';
	exit();
}

?>
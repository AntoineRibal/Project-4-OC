<?php



if(!isset($_GET['section']) OR $_GET['section'] == 'index')
{
	setcookie('pseudo', 'x', time() + 365*24*3600, null, null, false, true); 
	header('Location: C/c_routeur.php');
}
else
{
	include_once('/V/vue_error404.php');
}
?>
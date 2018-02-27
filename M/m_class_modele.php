<?php 

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '');
}
catch(Exception $e)
{
		die("Erreur : ".$e->getMessage());
}


class User
{
	private $_pseudo = '';
	private $_mail ='';
	private $_mdp='';

	public function getPseudo()
	{
		return $this->_pseudo;
	}
	public function setPseudo($name)
	{
		$this->_pseudo = $name;
		return $this->_pseudo;
	}
	public function setMail($mail)
	{
		$this->_mail = $mail;
		return $this->_mail;
	}
	public function setMdp($mdp)
	{
		$this->_mdp = $mdp;
		return $this->_mdp;
	}
	public static function recupAllUsers()
	{
		global $bdd;
		$reqUsers = $bdd->query('SELECT * FROM utilisateurs');
		return $reqUsers;
	}
	public function ecrireUser()
	{
		global $bdd;
		$a = $this->_pseudo;
		$b = $this->_mail;
		$c = $this->_mdp;
		$reqWrite = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mail, mdp ) VALUES(:pseudo,:mail, :mdp)');
		$reqWrite->execute(array(
			'pseudo' => htmlspecialchars($a),
			'mail' => htmlspecialchars($b),
			'mdp' => htmlspecialchars($c)
		));
	}
}

class Billet{
	private $_titre ='';
	private $_billet ='';
	private $_id ='';

	public function getBillet()
	{
		return $this->_billet;
	}
	public function getTitre()
	{
		return $this->_titre;
	}
	public function setTitre($titre)
	{
		$this->_titre = $titre;
		return $this->_titre;
	}
	public function setBillet($billet)
	{
		$this->_billet = $billet;
		return $this->_billet;
	}
	public function setId($id)
	{
		$this->_id = $id;
		return $this->_id;
	}
	public static function recupAllBillets()
	{
		global $bdd;
		$reqBillets = $bdd->query('SELECT * FROM billets');
		return $reqBillets;
	}
	public function ecrireBillet()
	{
		global $bdd;
		$d = $this->_titre;
		$f = $this->_billet;
		$reqWrite = $bdd->prepare('INSERT INTO billets(titre, texte) VALUES(:titre,:texte)');
		$reqWrite->execute(array(
			'titre' => htmlspecialchars($d),
			'texte' => $f
		));
	}
	public function modifBillet()
	{
		global $bdd;
		$g = $this->_titre;
		$h = $this->_billet;
		$i = $this->_id;
		$reqUpdate = $bdd->prepare('UPDATE billets SET titre = :nvtitre, texte = :nvtexte WHERE id = :nvId');
		$reqUpdate->execute(array(
			'nvtitre' => htmlspecialchars($g),
			'nvtexte' => $h,
			'nvId' => $i
		));
	}
	public function deleteBillet(){
		global $bdd;
		$j = $this->_id;
		$reqdelete = $bdd->prepare('DELETE FROM billets WHERE id = :delId');
		$reqdelete->execute(array(
			'delId' => $j
		));		
	}
}

class Commentaire{
	private $_commentaire ='';
	private $_auteur ='';
	private $_idBillet='';
	private $_idCom ='';
	private $_modo ='faux';

	public function getCommentaire()
	{
		return $this->_commentaire;
	}
	public function getAuteur()
	{
		return $this->_auteur;
	}
	public function getidBillet()
	{
		return $this->_idBillet;
	}
	public function setAuteur($auteur)
	{
		$this->_auteur = $auteur;
		return $this->_auteur;
	}
	public function setCommentaire($commentaire)
	{
		$this->_commentaire = $commentaire;
		return $this->_commentaire;
	}
	public function setidBillet($billetID)
	{
		$this->_idBillet = $billetID;
		return $this->_idBillet;
	}
	public function setidCom($idCom)
	{
		$this->_idCom = $idCom;
		return $this->_idCom;
	}
	public function setModo($modo)
	{
		$this->_modo = $modo;
		return $this->_modo;
	}
	public static function recupAllComments()
	{
		global $bdd;
		$reqCom = $bdd->query('
			SELECT c.texte, c.id_billet, c.modo, c.pseudo, c.id, u.pseudo, DATE_FORMAT(c.date_ajout, "%d/%m/%Y - %Hh%imin%ss") AS date_ajout
			FROM commentaires AS c
			INNER JOIN utilisateurs AS u 
			ON c.pseudo = u.id 
			ORDER BY c.id DESC
			');
		return $reqCom;
	}
	public function ecrireCommentaire()
	{
		global $bdd;
		$j = $this->_auteur;
		$k = $this->_commentaire;
		$l = $this->_idBillet;
		$ll = $this->_modo;
		$reqWrite = $bdd->prepare('INSERT INTO commentaires(pseudo, texte, id_billet, modo) VALUES(:pseudo,:texte,:idBillet,:modo)');
		$reqWrite->execute(array(
			'pseudo' => $j,
			'texte' => $k,
			'idBillet' => $l,
			'modo' => $ll
	
		));
	}
	public function deleteCommentaire(){
		global $bdd;
		$m = $this->_idCom;
		$reqdelete = $bdd->prepare('DELETE FROM commentaires WHERE id = :delId');
		$reqdelete->execute(array(
			'delId' => $m
		));		
	}
	public function signalerCommentaire(){
		global $bdd;
		$n = $this->_modo;
		$nn = $this->_idCom;
		$reqUpdate = $bdd->prepare('UPDATE commentaires SET modo = :nvmodo  WHERE id = :nvId');
		$reqUpdate->execute(array(
			'nvmodo' => $n,
			'nvId' => $nn
		));
	}
	public function designalerCommentaire(){
		global $bdd;
		$n = $this->_modo;
		$nn = $this->_idCom;
		$reqUpdate = $bdd->prepare('UPDATE commentaires SET modo = :nvmodo  WHERE id = :nvId');
		$reqUpdate->execute(array(
			'nvmodo' => $n,
			'nvId' => $nn
		));
	}


}
/*	
	private $commentaires;
	static function readComment(){
		$req0 = $bdd->query('SELECT * FROM commentaires');
		return $requ0;
	}
	static function writeComment($message, $billet){
		$req1 = $bdd->prepare('INSERT INTO commentaires(pseudo, texte, id_billet) VALUES(:pseudo, :texte, :id_billet)');
		$req1->execute(array(
			'pseudo' => htmlspecialchars($_COOKIE['pseudo']),
			'texte' => htmlspecialchars(message),
			'id_billet' => billet
		));
	}
	static function deleteComment($idComment){
		$req2->query('DELETE FROM commentaires WHERE id=idComment');
	}
	static function readBillet(){
		$req3 = $bdd->query('SELECT * FROM billets');
		return $req3;
	}
	static function writeBillet($titre, $contenu){
		//ecriture dans billets --> voir tinyMCE
	}
	static function updateBillet($titre, $contenu){
		//modification d'un billet avec (UPDATE x "SET y = z" WHERE a)
	}
	static function deleteBillet($id_billet){
		//suppression d'un billet avec DELETE
	}
	public static function readUser(){
		
		global $bdd;
		$reqY = $bdd->query('SELECT * FROM utilisateurs');
		return $reqY;
	}
	public static function writeUser($pseudo $mail $mdp){
		global $bdd;
		$reqX = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mail, mdp ) VALUES(:pseudo,:mail, :mdp)');
		$reqX->execute(array(
			'pseudo' => htmlspecialchars($pseudo),
			'mail' => htmlspecialchars($mail),
			'mdp' => htmlspecialchars($password),
		));		
	}
}
*/
?>

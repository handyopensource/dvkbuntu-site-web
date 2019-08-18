<?php
session_start();
if(isset($_SESSION['id']))
{
	$_SESSION = array();
	session_destroy();
    
    setcookie('id', '', time() - 1, null, null, false, true);
	setcookie('email', '', time() - 1, null, null, false, true);
	setcookie('confirmcookie', '', time() - 1, null, null, false, true); 

	header("Location: connexion.php");
}
else
{
	header('Location: connexion.php');
}

?>
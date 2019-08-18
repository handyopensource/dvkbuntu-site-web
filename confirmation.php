<?php
include 'header.php'; 

if(isset($_GET['key']) AND isset($_GET['id']) AND !empty($_GET['key']) AND !empty($_GET['id']))
{
    $key = htmlspecialchars($_GET['key']);
    $id = htmlspecialchars($_GET['id']);
    
    $reqkey = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $reqkey->execute(array($id));
    $keyinfo = $reqkey->fetch();
        
    if($keyinfo['confirmkey'] == $key)
    {
        $reqUp = $bdd->prepare('UPDATE utilisateurs SET confirmer = 1 WHERE id = ?');
        $reqUp->execute(array($id));
        header('Location: connexion.php?redirect=9753792');
    }
    else
    {
        header('Location: register.php?redirect=9753792');
    }
}
else
{
    header('Location: register.php?redirect=3863212');
}
?>
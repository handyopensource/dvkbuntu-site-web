<?php
session_start();

include 'header.php'; 

if(isset($_GET['id']) AND !empty($_GET['id']))
{
    $id = htmlspecialchars($_GET['id']);
    
    $reqUser = $bdd->prepare('SELECT * FROM documents WHERE id = ?');
    $reqUser->execute(array($id));
    $userexist = $reqUser->rowCount();
    $docInfo = $reqUser->fetch();
        
    if($userexist == 1)
    {
        if($_SESSION['admin'] == 1)
        {
            unlink("images/docs/".$docInfo['image']."");
            $reqDelete = $bdd->prepare('DELETE FROM documents WHERE id = ?');
            $reqDelete->execute(array($id));
            header('Location: gestion.php');
        }
        else
        {
            header('Location: erreur.php');
        }
    }
    else
    {
        header('Location: erreur.php');
    }
}
else
{
    header('Location: erreur.php');
}
?>
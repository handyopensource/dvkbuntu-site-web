<?php
session_start();

include 'header.php'; 

if(isset($_SESSION['id']))
{
    header('Location: index.php');
}
else
{
    if(isset($_COOKIE['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['confirmcookie']))
    {
        $id = htmlspecialchars($_COOKIE['id']);
        $email = htmlspecialchars($_COOKIE['email']);
        $confirmcookie = htmlspecialchars($_COOKIE['confirmcookie']);

        $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ? AND email = ? AND confirmcookie = ?');
        $requser->execute(array($id, $email, $confirmcookie));
        $userexist = $requser->rowCount();

        if($userexist == 1)
        {
            $userinfo = $requser->fetch();

            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['admin'] = $userinfo['admin'];
            $_SESSION['auteur_actu'] = $userinfo['auteur_actu'];
            $_SESSION['auteur_doc'] = $userinfo['auteur_doc'];
            header('Location: index.php');
        }
        else
        {
            header('Location: index.php');
        }
    }
    else
    {
        header('Location: index.php');
    }
}

?>
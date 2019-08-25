<?php
session_start();

if(!empty($_SESSION["mode"]))
{
    if($_SESSION["mode"] == "sombre")
    {
        $_SESSION["mode"] = "clair";
        
        if(isset($_GET['id']) AND !empty($_GET['id']))
        {
            $id = intval($_GET['id']);
            if($id == 1) {
                header('Location: actualite.php');
            }
            elseif($id == 2) {
                header('Location: add_actu.php');
            }
            elseif($id == 3) {
                header('Location: add_doc.php');
            }
            elseif($id == 4) {
                header('Location: add_auteur.php');
            }
            elseif($id == 5) {
                header('Location: connexion.php');
            }
            elseif($id == 6) {
                header('Location: contact.php');
            }
            elseif($id == 7) {
                header('Location: doc.php');
            }
            elseif($id == 8) {
                header('Location: donnation.php');
            }
            elseif($id == 11) {
                header('Location: erreur.php');
            }
            elseif($id == 12) {
                header('Location: gestion.php');
            }
            elseif($id == 13) {
                header('Location: list_actu.php');
            }
            elseif($id == 14) {
                header('Location: list_doc.php');
            }
            elseif($id == 18) {
                header('Location: recherche.php');
            }
            elseif($id == 19) {
                header('Location: telecharger.php');
            }
            elseif($id == 20) {
                header('Location: open-source.php');
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
    else
    {
        $_SESSION["mode"] = "sombre";
        if(isset($_GET['id']) AND !empty($_GET['id']))
        {
            $id = intval($_GET['id']);
            if($id == 1) {
                header('Location: actualite.php');
            }
            elseif($id == 2) {
                header('Location: add_actu.php');
            }
            elseif($id == 3) {
                header('Location: add_doc.php');
            }
            elseif($id == 4) {
                header('Location: add_auteur.php');
            }
            elseif($id == 5) {
                header('Location: connexion.php');
            }
            elseif($id == 6) {
                header('Location: contact.php');
            }
            elseif($id == 7) {
                header('Location: doc.php');
            }
            elseif($id == 8) {
                header('Location: donnation.php');
            }
            elseif($id == 11) {
                header('Location: erreur.php');
            }
            elseif($id == 12) {
                header('Location: gestion.php');
            }
            elseif($id == 13) {
                header('Location: list_actu.php');
            }
            elseif($id == 14) {
                header('Location: list_doc.php');
            }
            elseif($id == 18) {
                header('Location: recherche.php');
            }
            elseif($id == 19) {
                header('Location: telecharger.php');
            }
            elseif($id == 20) {
                header('Location: open-source.php');
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
}
else
{
    $_SESSION["mode"] = "sombre";
    if(isset($_GET['id']) AND !empty($_GET['id']))
        {
            $id = intval($_GET['id']);
            if($id == 1) {
                header('Location: actualite.php');
            }
            elseif($id == 2) {
                header('Location: add_actu.php');
            }
            elseif($id == 3) {
                header('Location: add_doc.php');
            }
            elseif($id == 4) {
                header('Location: add_auteur.php');
            }
            elseif($id == 5) {
                header('Location: connexion.php');
            }
            elseif($id == 6) {
                header('Location: contact.php');
            }
            elseif($id == 7) {
                header('Location: doc.php');
            }
            elseif($id == 8) {
                header('Location: donnation.php');
            }
            elseif($id == 11) {
                header('Location: erreur.php');
            }
            elseif($id == 12) {
                header('Location: gestion.php');
            }
            elseif($id == 13) {
                header('Location: list_actu.php');
            }
            elseif($id == 14) {
                header('Location: list_doc.php');
            }
            elseif($id == 18) {
                header('Location: recherche.php');
            }
            elseif($id == 19) {
                header('Location: telecharger.php');
            }
            elseif($id == 20) {
                header('Location: open-source.php');
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

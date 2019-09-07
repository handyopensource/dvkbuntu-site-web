<?php
session_start();

include 'header.php'; 

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}

if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
{ 

if(isset($_GET['id']))
{
    $getid = intval($_GET['id']);
    $reqactu = $bdd->prepare('SELECT * FROM actualites WHERE id = ?');
    $reqactu->execute(array($getid));
    $actuExist = $reqactu->rowCount();
                                    
    if($actuExist == 1)
    {
        $donnees = $reqactu->fetch();
       
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
    
//ACTU
    
if(isset($_POST['envoi']))
{
    $titre = htmlspecialchars($_POST['titre']);
    $description = $_POST['description'];

    
    if(!empty($titre) AND !empty($description))
    {
        $titrelenght = strlen($titre);
        $descriptionlenght = strlen($description);
        
        if($titrelenght <= 255 AND $descriptionlenght <= 5000)
        {
            if(!empty($_FILES['couverture']['name']))
            {  
                $dossier = 'images/actus/';
                $taille_maxi = 10000000;
                $taille = filesize($_FILES['couverture']['tmp_name']);
                $extensions = array('.png', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['couverture']['name'], '.'); 

                if(!empty($donnees['image']))
                {
                    $fichier = $donnees['image'];
                }
                else
                {
                    $longueurKey = 9;
                    $key = "";
                    for($i=1;$i<$longueurKey;$i++) 
                    {
                        $key .= mt_rand(0,9);
                    }

                    $fichier = $donnees['auteur'].'-'.$key.'-couverture'.$extension;
                }
                //Début des vérifications de sécurité...
                if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                {
                    $erreur = 'Vous devez uploader un fichier de type png/jpg/jpeg...';
                }
                if($taille>$taille_maxi)
                {
                    $erreur = 'Le fichier est trop gros...';
                }
                if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                {
                    if(move_uploaded_file($_FILES['couverture']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                    {                 
                        $req = $bdd->prepare('UPDATE actualites SET titre = :titre, description = :description, image = :image, valider = 1 WHERE id = :id');
                        $req->execute(array(
                                'titre' => $titre,
                                'description' => $description,
                                'image' => $fichier,
                                'id' => $getid
                               ));
                        $req->closeCursor();
                        /*GET "auteur"*/
                        $reqdoc = $bdd->prepare('SELECT * FROM actualites WHERE id = ?');
                        $reqdoc->execute(array($id));
                        $docInfo = $reqdoc->fetch();
                        /*GET "email"*/
                        $reqUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE nom = ?');
                        $reqUser->execute(array($docInfo['auteur']));
                        $userInfo = $reqUser->fetch();
                        $mail = $userInfo['email'];


                        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
                        {
                            $passage_ligne = "\r\n";
                        }
                        else
                        {
                            $passage_ligne = "\n";
                        }

                        //=====Déclaration des messages au format texte et au format HTML.
                        $message_txt = "Votre actualité a bien été validé";
                        $message_html = "Votre actualité a bien été validée ! /n
                        <html>
                        <head>
                        <meta charset=\"utf-8\"/>
                        </head>
                        <body>
                        <div align=\"center\">
                        <font color=\"#003DB3\"><h1>Votre actualité a bien été validée par un administrateur, merci de votre participation !</h1></font><br/>
                        </div>
                        <hr>
                        <small>
                        <i>Si vous avez reçu ce mail par erreur, veuillez l'effacer et ne pas tenir compte des informations qui s'y trouvent.</i>
                        </small>
                        </body>
                        </html>";

                        //=====Création de la boundary

                        $boundary = "-----=".md5(rand());

                        //=====Définition du sujet.

                        $sujet = "Actualité validée !";

                        //=====Création du header de l'e-mail.

                        $header = "From: \"DVKBuntu\"<no-reply@dvkbuntu.org>".$passage_ligne;
                        $header.= "Reply-to: \"DVKBuntu\" <no-reply@dvkbuntu.org>".$passage_ligne;
                        $header.= "MIME-Version: 1.0".$passage_ligne;
                        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

                        //=====Création du message.

                        $message = $passage_ligne."--".$boundary.$passage_ligne;

                        //=====Ajout du message au format texte.

                        $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
                        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                        $message.= $passage_ligne.$message_txt.$passage_ligne;

                        //==========

                        $message.= $passage_ligne."--".$boundary.$passage_ligne;

                        //=====Ajout du message au format HTML

                        $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
                        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                        $message.= $passage_ligne.$message_html.$passage_ligne;

                        //==========

                        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
                        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

                        //=====Envoi de l'e-mail.

                        mail($mail,$sujet,$message,$header);

                        $reqdoc->closeCursor();
                        $reqUser->closeCursor();
                        $victory = "L'actualité a bien été envoyée.";
                        header('Location: gestion.php');
                    }   
                    else //Sinon (la fonction renvoie FALSE).
                    {
                        $erreur = "Echec de l'upload !";
                    } //fin de la 7eme condition
                } //fin de la 6eme condition
            }
            else
            {
                $req = $bdd->prepare('UPDATE actualites SET titre = :titre, description = :description, valider = 1 WHERE id = :id');
                $req->execute(array(
                        'titre' => $titre,
                        'description' => $description,
                        'id' => $getid
                       ));
                $req->closeCursor();
                /*GET "auteur"*/
                $reqdoc = $bdd->prepare('SELECT * FROM actualites WHERE id = ?');
                $reqdoc->execute(array($id));
                $docInfo = $reqdoc->fetch();
                /*GET "email"*/
                $reqUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE nom = ?');
                $reqUser->execute(array($docInfo['auteur']));
                $userInfo = $reqUser->fetch();
                $mail = $userInfo['email'];


                if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
                {
                    $passage_ligne = "\r\n";
                }
                else
                {
                    $passage_ligne = "\n";
                }

                //=====Déclaration des messages au format texte et au format HTML.
                $message_txt = "Votre actualité a bien été validé";
                $message_html = "Votre actualité a bien été validée ! /n
                <html>
                <head>
                <meta charset=\"utf-8\"/>
                </head>
                <body>
                <div align=\"center\">
                <font color=\"#003DB3\"><h1>Votre actualité a bien été validée par un administrateur, merci de votre participation !</h1></font><br/>
                </div>
                <hr>
                <small>
                <i>Si vous avez reçu ce mail par erreur, veuillez l'effacer et ne pas tenir compte des informations qui s'y trouvent.</i>
                </small>
                </body>
                </html>";

                //=====Création de la boundary

                $boundary = "-----=".md5(rand());

                //=====Définition du sujet.

                $sujet = "Actualité validée !";

                //=====Création du header de l'e-mail.

                $header = "From: \"DVKBuntu\"<noreply.decanniere@gmail.com>".$passage_ligne;
                $header.= "Reply-to: \"DVKBuntu\" <noreply.decaniere@gmail.com>".$passage_ligne;
                $header.= "MIME-Version: 1.0".$passage_ligne;
                $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

                //=====Création du message.

                $message = $passage_ligne."--".$boundary.$passage_ligne;

                //=====Ajout du message au format texte.

                $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
                $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                $message.= $passage_ligne.$message_txt.$passage_ligne;

                //==========

                $message.= $passage_ligne."--".$boundary.$passage_ligne;

                //=====Ajout du message au format HTML

                $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
                $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                $message.= $passage_ligne.$message_html.$passage_ligne;

                //==========

                $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
                $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

                //=====Envoi de l'e-mail.

                mail($mail,$sujet,$message,$header);

                $reqdoc->closeCursor();
                $reqUser->closeCursor();
                $victory = "L'actualité a bien été envoyée.";
                header('Location: gestion.php');
            }   //fin de la 5eme condition
        }
        else
        {
            $erreur = "Titre ou description trop long !";
        }   //fin de la 3eme condition
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }    //fin de la 2eme condition
    
}  //fin de la 1ere condition
 
?>

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>DVKBuntu - Valider actu</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<?php
        if($_SESSION['mode'] == "sombre")
        {?>
		  <link rel="stylesheet" href="assets/css/main.css" />
        <?php }
        else
        { ?>
            <link rel="stylesheet" href="assets/css/main_clair.css" />
        <?php } ?>
        <link rel="icon" type="image/png" href="images/LogoGenerale.png" />	

	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.php" class="logo"><strong>DVKBuntu</strong></a>
									<ul class="icons">
                                       <li><a href="mode.php?id=19" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
                                        <li><a href="https://twitter.com/handyopensource" class="icons-header" alt="Twitter"><i class="fab fa-twitter-square fa-lg"></i></a></li>
                                        <li><a href="https://www.facebook.com/Handyopensource" class="icons-header" alt="Facebbok"><i class="fab fa-facebook fa-lg"></i></a></li>
                                        <li><a href="https://discord.gg/zG7g8cU" class="icons-header" alt="discord"><i class="fab fa-discord fa-lg"></i></a></li>
                                        <li><a href="https://www.forum.dvkbuntu.org/" class="icons-header" alt="Le forum"><i class="far fa-comments fa-lg"></i></a></li>
                                        <li><a href="#contact" class="icons-header" alt="Email"><i class="far fa-envelope fa-lg"></i></a></li>
                                       <li> <a href="donnation.php" class="icons-header" alt="Email" class="icons"><i class="fas fa-hand-holding-usd fa-lg"></i></a></li>
                                        
									</ul>
								</header>

                        <!-- Content -->
								<section>
									
                                    
                                    <header class="main">
										<h1>Valider une actualité</h1>
                                        <strong>
                                        <font color="red">
                                        <?php if(isset($erreur))
                                        {
                                            echo $erreur;
                                        } ?>
                                        </font>
                                        <font color="green">
                                        <?php if(isset($victory))
                                        {
                                            echo $victory;
                                        } ?>
                                        </font>
                                        </strong>
                                        <br/>
                                        <br/>
									</header>
                        
									<form method="post" enctype="multipart/form-data">
                                        <div class="row gtr-uniform">
                                            <div class="col-6 col-12-xsmall">
                                                <label for="file">Changer l'image de couverture :</label>
                                                <input type="file" name="couverture" id="file" accept="image/png, image/jpeg, image/jpg"/>
                                            </div>
                                            <hr/>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="titre" id="titre" value="<?php echo $donnees['titre'] ?>" />
                                            </div>
                                            <hr/>
                                            <div class="col-6 col-12-small">
                                                <textarea name="description" id="texte" maxlength="5000" rows="9"><?php echo $donnees['description'] ?></textarea>
                                                
                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Valider" class="primary" name="envoi"/></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
    
								</section>

						</div>
					</div>

				  <!-- Sidebar -->
					<?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
                &emsp;
                <a href="https://twitter.com/handyopensource" class="icons" alt="Twitter"><i class="fab fa-twitter-square fa-lg"></i></a>
                <a href="https://www.facebook.com/Handyopensource" class="icons" alt="Facebbok"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="https://discord.gg/zG7g8cU" class="icons" alt="discord"><i class="fab fa-discord fa-lg"></i></a>
                <a href="https://www.forum.dvkbuntu.org/" class="icons" alt="Le forum"><i class="far fa-comments fa-lg"></i></a>
               <a href="contact.php" class="icons" alt="Email"><i class="far fa-envelope fa-lg"></i></a>
                <a href="donnation.php" class="icons" alt="Email" class="icons"><i class="fas fa-hand-holding-usd fa-lg"></i></a>
            </div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php }
elseif(isset($_COOKIE['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['confirmcookie']))
{
    header('Location: cookie.php');
}
else
{
    header('Location: erreur.php');
}
?>
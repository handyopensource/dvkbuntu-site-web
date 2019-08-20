<?php
session_start();

include 'header.php'; 

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}

if(isset($_SESSION['id']))
{
    if($_SESSION['auteur_doc'] == 1 OR $_SESSION['admin'] == 1)
    { 
        if(isset($_POST['enregistrer']))
        {
            if(isset($_SESSION['titre']) AND !empty($_SESSION['titre']) AND isset($_SESSION['texte']) AND !empty($_SESSION['texte']))
            {
                $titre = $_SESSION['titre'];
                $texte = $_SESSION['texte'];
                
                $titreconnectlenght = strlen($titre);
                $texteconnectlenght = strlen($texte);

                if($titreconnectlenght <= 255 AND $texteconnectlenght <= 5000)
                {
                    $reqactu = $bdd->prepare('SELECT * FROM documents WHERE titre = ?');
                    $reqactu->execute(array($titre));
                    $actuexist = $reqactu->rowCount();

                    if($actuexist == 1)
                    {
                        $erreur = "Il y a déjà une documentation qui porte ce titre !";
                    }
                    else
                    {
                        if(!empty($_FILES['couverture']['name']))
                        {  
                            $dossier = 'images/docs/';
                            $taille_maxi = 10000000;
                            $taille = filesize($_FILES['couverture']['tmp_name']);
                            $extensions = array('.png', '.jpg', '.jpeg');
                            $extension = strrchr($_FILES['couverture']['name'], '.'); 

                            $longueurKey = 9;
                            $key = "";
                            for($i=1;$i<$longueurKey;$i++) 
                            {
                                $key .= mt_rand(0,9);
                            }

                            $fichier = $_SESSION['nom'].'-'.$key.'-couverture'.$extension;
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
                                    $req = $bdd->prepare('INSERT INTO documents(auteur, titre, description, image) VALUES(:auteur, :titre, :description, :image)');
                                    $req->execute(array(
                                        'auteur' => $_SESSION['nom'],
                                        'titre' => $titre,
                                        'description' => $texte,
                                        'image' => $fichier
                                       ));
                                    
                                    unset($_SESSION['titre']);
                                    unset($_SESSION['texte']);
                                    
                                    $reqAdmin = $bdd->query('SELECT * FROM utilisateurs WHERE admin = 1');
                                    while($infos = $reqAdmin->fetch())
                                    {
                                        $email = $infos['email'];
                                        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
                                        {
                                            $passage_ligne = "\r\n";
                                        }
                                        else
                                        {
                                            $passage_ligne = "\n";
                                        }

                                        //=====Déclaration des messages au format texte et au format HTML.

                                        $message_txt = "Nouvelle documentation sur DVKBuntu.org ! /n
                                        Validez la dès maintenant : dvkbuntu.org/gestion.php";
                                        $message_html = "<html>
                                        <head>
                                        <meta charset=\"utf-8\"/>
                                        </head>
                                        <body>
                                        <div align=\"center\">
                                        <font color=\"#003DB3\"><h1>Nouvelle documentation sur DVKBuntu.org !</h1></font><br/>
                                        </div>
                                        <hr>
                                        <div align=\"center\">
                                        <h2>Validez la dès maintenant : <a href=\"dvkbuntu.org/gestion.php\">dvkbuntu.org/gestion.php</a></h2>
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

                                        $sujet = "Nouvelle documentation !";

                                        //=====Création du header de l'e-mail.

                                        $header = "From: \"DVKBuntu\"<_mainaccount@paulluxwaffl.odns.fr>".$passage_ligne;
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

                                        mail($email,$sujet,$message,$header);
                                    }
                                    
                                    $victory = "Votre documentation a bien été envoyée. Elle est en attente de validation par l'un des nos administrateurs.";
                                }   
                                else //Sinon (la fonction renvoie FALSE).
                                {
                                    $erreur = "Echec de l'upload !";
                                } 
                            }
                        }
                        else
                        {
                            $req = $bdd->prepare('INSERT INTO documents(auteur, titre, description) VALUES(:auteur, :titre, :description)');
                                                $req->execute(array(
                                                        'auteur' => $_SESSION['nom'],
                                                        'titre' => $titre,
                                                        'description' => $texte
                                                       ));
                            unset($_SESSION['titre']);
                            unset($_SESSION['texte']);
                            
                            $reqAdmin = $bdd->query('SELECT * FROM utilisateurs WHERE admin = 1');
                            while($infos = $reqAdmin->fetch())
                            {
                                $email = $infos['email'];
                                if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
                                {
                                    $passage_ligne = "\r\n";
                                }
                                else
                                {
                                    $passage_ligne = "\n";
                                }

                                //=====Déclaration des messages au format texte et au format HTML.

                                $message_txt = "Nouvelle documentation sur DVKBuntu.org ! /n
                                Validez la dès maintenant : dvkbuntu.org/gestion.php";
                                $message_html = "<html>
                                <head>
                                <meta charset=\"utf-8\"/>
                                </head>
                                <body>
                                <div align=\"center\">
                                <font color=\"#003DB3\"><h1>Nouvelle documentation sur DVKBuntu.org !</h1></font><br/>
                                </div>
                                <hr>
                                <div align=\"center\">
                                <h2>Validez la dès maintenant : <a href=\"dvkbuntu.org/gestion.php\">dvkbuntu.org/gestion.php</a></h2>
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

                                $sujet = "Nouvelle documentation !";

                                //=====Création du header de l'e-mail.

                                $header = "From: \"DVKBuntu\"<_mainaccount@paulluxwaffl.odns.fr>".$passage_ligne;
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

                                mail($email,$sujet,$message,$header);
                            }

                            $victory = "Votre documentation a bien été envoyée. Elle est en attente de validation par l'un des nos administrateurs.";
                        }  

                    }  
                }
                else
                {
                    $erreur = "Titre ou texte trop long !";
                }   
            }
            else
            {
                $erreur = "Tous les champs doivent être complétés !";
            }   
            
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>DVKBuntu - Ajouter documentation</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						  
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
                                       <li><a href="mode.php?id=10" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
                                    <h2>
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
                                    </h2>
                                    <br/>
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
    <?php 
        }
        else
        {
            header('Location: erreur.php');
        } //fin 3eme condition
    }
    else
    {
        header('Location: erreur.php');
    } //fin 2eme condition
    
}
elseif(isset($_COOKIE['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['confirmcookie']))
{
    header('Location: cookie.php');
}
else
{
    header('Location: index.php');
} //fin 1ere condition
?>

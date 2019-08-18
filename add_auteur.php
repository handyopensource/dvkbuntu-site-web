<?php
session_start();

include 'header.php';

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}

//ajouter
if(isset($_POST['ajout_actu']))
{
    $email = htmlspecialchars($_POST['email']);
    
    if(!empty($email))
    {
        $emaillenght = strlen($email);
        
        if($emaillenght <= 255)
        {
            $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $requser->execute(array($email));
            $userexist = $requser->rowCount();

            if($userexist == 1)
            {
                $req = $bdd->prepare('UPDATE utilisateurs SET auteur_actu = 1 WHERE email = ?');
                $req->execute(array($email));

                $req->closeCursor();
                if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
                {
                    $passage_ligne = "\r\n";
                }
                else
                {
                    $passage_ligne = "\n";
                }

                //=====Déclaration des messages au format texte et au format HTML.

                $message_txt = "Vous etes auteur pour l'actualités sur DVKBuntu.org ! /n
                Commencez à poster dès maintenant : dvkbuntu.org/add_actu.php";
                $message_html = "<html>
                <head>
                <meta charset=\"utf-8\"/>
                </head>
                <body>
                <div align=\"center\">
                <font color=\"#003DB3\"><h1>Vous etes auteur pour l'actualités sur DVKBuntu.org !</h1></font><br/>
                </div>
                <hr>
                <div align=\"center\">
                <h2>Commencez à poster dès maintenant : <a href=\"dvkbuntu.org/add_doc.php\">dvkbuntu.org/add_actu.php</a></h2>
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

                $sujet = "Nomination comme auteur d'actualités !";

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

                $victory = "Bien ajouté aux actualités !";
            }
            else
            {
                $erreur = "Email invalide !";
            }  //fin de la 4eme condition
        }
        else
        {
            $erreur = "Email trop long !";
        }   //fin de la 3eme condition
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }    //fin de la 2eme condition
    
}  //fin de la 1ere condition

if(isset($_POST['ajout_doc']))
{
    $email = htmlspecialchars($_POST['email']);
    
    if(!empty($email))
    {
        $emaillenght = strlen($email);
        
        if($emaillenght <= 255)
        {
            $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $requser->execute(array($email));
            $userexist = $requser->rowCount();

            if($userexist == 1)
            {
                $req = $bdd->prepare('UPDATE utilisateurs SET auteur_doc = 1 WHERE email = ?');
                $req->execute(array($email));

                $req->closeCursor();
                if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
                {
                    $passage_ligne = "\r\n";
                }
                else
                {
                    $passage_ligne = "\n";
                }

                //=====Déclaration des messages au format texte et au format HTML.

                $message_txt = "Vous etes auteur pour la documentation sur DVKBuntu.org ! /n
                Commencez à poster dès maintenant : dvkbuntu.org/add_doc.php";
                $message_html = "<html>
                <head>
                <meta charset=\"utf-8\"/>
                </head>
                <body>
                <div align=\"center\">
                <font color=\"#003DB3\"><h1>Vous etes auteur pour la documentation sur DVKBuntu.org !</h1></font><br/>
                </div>
                <hr>
                <div align=\"center\">
                <h2>Commencez à poster dès maintenant : <a href=\"dvkbuntu.org/add_doc.php\">dvkbuntu.org/add_doc.php</a></h2>
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

                $sujet = "Nomination comme auteur de documentation !";

                //=====Création du header de l'e-mail.

                $header = "From: \"DVKBuntu\"<noreply.decanniere@gmail.com>".$passage_ligne;
                $header.= "Reply-to: \"DVKBuntu\" <handyopensourcedvkbuntu@gmail.com>".$passage_ligne;
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

                $victory = "Bien ajouté à la documentation !";
            }
            else
            {
                $erreur = "Email invalide !";
            }  //fin de la 4eme condition
        }
        else
        {
            $erreur = "Email trop long !";
        }   //fin de la 3eme condition
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }    //fin de la 2eme condition
    
}  //fin de la 1ere condition

//enlever
if(isset($_POST['enlever_actu']))
{
    $email = htmlspecialchars($_POST['email']);
    
    if(!empty($email))
    {
        $emaillenght = strlen($email);
        
        if($emaillenght <= 255)
        {
            $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $requser->execute(array($email));
            $userexist = $requser->rowCount();

            if($userexist == 1)
            {
                $req = $bdd->prepare('UPDATE utilisateurs SET auteur_actu = 0 WHERE email = ?');
                $req->execute(array($email));

                $req->closeCursor();


                $victory_enlever = "Bien enlevé aux actualités !";
            }
            else
            {
                $erreur_enlever = "Email invalide !";
            }  //fin de la 4eme condition
        }
        else
        {
            $erreur_enlever = "Email trop long !";
        }   //fin de la 3eme condition
    }
    else
    {
        $erreur_enlever = "Tous les champs doivent être complétés !";
    }    //fin de la 2eme condition
    
}  //fin de la 1ere condition

if(isset($_POST['enlever_doc']))
{
    $email = htmlspecialchars($_POST['email']);
    
    if(!empty($email))
    {
        $emaillenght = strlen($email);
        
        if($emaillenght <= 255)
        {
            $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $requser->execute(array($email));
            $userexist = $requser->rowCount();

            if($userexist == 1)
            {
                $req = $bdd->prepare('UPDATE utilisateurs SET auteur_doc = 0 WHERE email = ?');
                $req->execute(array($email));

                $req->closeCursor();


                $victory_enlever = "Bien enlevé à la documentation !";
            }
            else
            {
                $erreur_enlever = "Email invalide !";
            }  //fin de la 4eme condition
        }
        else
        {
            $erreur_enlever = "Email trop long !";
        }   //fin de la 3eme condition
    }
    else
    {
        $erreur_enlever = "Tous les champs doivent être complétés !";
    }    //fin de la 2eme condition
    
}  //fin de la 1ere condition

if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
{ ?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>DVKBuntu - Se connecter</title>
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
                                       <li><a href="mode.php?id=4" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Ajouter un auteur</h1>
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

									<form method="post">
                                        <div class="row gtr-uniform">
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="email" id="email" value="" placeholder="Email" />
                                            </div>
                                            
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Actualités" class="primary" name="ajout_actu"/></li>
                                                    <li><input type="submit" value="Documentation" class="primary" name="ajout_doc"/></li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </form>
								</section>
                                
                                <section>
									<header class="main">
										<h1>Enlever un auteur</h1>
                                        <strong>
                                        <font color="red">
                                        <?php if(isset($erreur_enlever))
                                        {
                                            echo $erreur_enlever;
                                        } ?>
                                        </font>
                                        <font color="green">
                                        <?php if(isset($victory_enlever))
                                        {
                                            echo $victory_enlever;
                                        } ?>
                                        </font>
                                        </strong>
                                        <br/>
                                        <br/>
									</header>

									<form method="post">
                                        <div class="row gtr-uniform">
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="email" id="email" value="" placeholder="Email" />
                                            </div>
                                            
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Actualités" class="primary" name="enlever_actu"/></li>
                                                    <li><input type="submit" value="Documentation" class="primary" name="enlever_doc"/></li>
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
                <a href="mode.php?id=4" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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

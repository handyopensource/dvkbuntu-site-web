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
    header('Location: index.php');
}
elseif(isset($_COOKIE['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['confirmcookie']))
{
    header('Location: cookie.php');
}
else
{

if(isset($_POST['inscription']))
{   
    if(!empty(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND $_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
       
        $password = sha1($_POST['password']);
        $password2 = sha1($_POST['password2']);
        
        $nomlenght = strlen($nom);
        $prenomlenght = strlen($prenom);
        $maillenght = strlen($mail);
        $mail2lenght = strlen($mail2);
        $passwordlenght = strlen($_POST['password']);
        $password2lenght = strlen($_POST['password2']);

        if($nomlenght <= 255 AND $prenomlenght <= 255 AND $maillenght <= 255 AND $mail2lenght <= 255 AND $passwordlenght <= 255 AND $password2lenght <= 255)
            {
                if($mail == $mail2)
                {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                    {
                        $reqmail = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        if($mailexist == 0)
                        {
                            if($password == $password2)
                            {
                                if($passwordlenght > 4)
                                {
                                    $longueurKey = 15;
                                    $key = "";
                                    for($i=1;$i<$longueurKey;$i++) 
                                    {
                                        $key .= mt_rand(0,9);
                                    }

                                    $req = $bdd->prepare('INSERT INTO utilisateurs(nom, email, motdepasse, confirmkey) VALUES(:nom, :email, :motdepasse, :confirmkey)');
                                    $req->execute(array(
                                            'nom' => $prenom." ".$nom,
                                            'email' => $mail,
                                            'motdepasse' => $password,
                                            'confirmkey' => $key
                                           ));
                                    
                                    $reqID = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
                                    $reqID->execute(array($mail));
                                    $userinfo = $reqID->fetch();
                                    
                                    
                                    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
                                    {
                                        $passage_ligne = "\r\n";
                                    }
                                    else
                                    {
                                        $passage_ligne = "\n";
                                    }

                                    //=====Déclaration des messages au format texte et au format HTML.

                                    $message_txt = "Bienvenue sur DVKBuntu.org ! /n
                                    Veuillez confirmez votre compte en suivant ce lien : dvkbuntu.org/confirmation.php?key=".$key."&id=".$userinfo['id']."";
                                    $message_html = "<html>
                                    <head>
                                    <meta charset=\"utf-8\"/>
                                    </head>
                                    <body>
                                    <div align=\"center\">
                                    <font color=\"#003DB3\"><h1>Bienvenue sur DVKBuntu.org !</h1></font><br/>
                                    </div>
                                    <hr>
                                    <div align=\"center\">
                                    <h2>Confirmer votre compte en cliquant <a href=\"dvkbuntu.org/confirmation.php?key=".$key."&id=".$userinfo['id']."\">ici</a> ou en copiant le lien suivant dans votre navigateur : <a href=\"http://dvkbuntu.org/confirmation.php?key=".$key."&id=".$userinfo['id']."\">http://dvkbuntu.org/confirmation.php?key=".$key."&id=".$userinfo['id']."</a></h2>
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

                                    $sujet = "Bienvenue sur DVKBuntu !";

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

                                    mail($mail,$sujet,$message,$header);
                                    
                                    $victoryinscription = "Votre compte a bien été créé! Activez-le via le mail qui vous a été envoyé !";
                                    header('Location:connexion.php?redirect=45672182');
                                }
                                else
                                {
                                    $erreurinscription = "Votre mot de passe est trop court !";
                                }    //fin de la 8eme condition
                            }
                            else
                            {   
                                $erreurinscription = "Les mots de passe ne correspondent pas !";
                            }  //fin de la 7eme condition
                        }
                        else
                        {
                            $erreurinscription = "Votre adresse mail est déjà utilisée !";
                        }  //fin de la 6eme condition
                    }
                    else
                    {
                        $erreurinscription = "Votre adresse mail n'est pas valide !";
                    }  //fin de la 5eme condition
                }
                else
                {
                    $erreurinscription = "Les emails ne correspondent pas !";
                }  //fin de la 4eme condition
            }
            else
            {
                $erreurinscription = "Certains champs sont trop longs !";
            }   //fin de la 3eme condition
    }
    else
    {
        $erreurinscription = "Tous les champs doivent être complétés !";
    }   //fin de la 2eme condition
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
		<title>DVKBuntu - S'enregistrer</title>
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
                                       <li><a href="mode.php" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
                                        <li><a href="https://twitter.com/handyopensource" class="icons-header" alt="Twitter"><i class="fab fa-twitter-square fa-lg"></i></a></li>
                                        <li><a href="https://www.facebook.com/Handyopensource" class="icons-header" alt="Facebbok"><i class="fab fa-facebook fa-lg"></i></a></li>
                                        <li><a href="https://discord.gg/zG7g8cU" class="icons-header" alt="discord"><i class="fab fa-discord fa-lg"></i></a></li>
                                        <li><a href="https://www.forum.dvkbuntu.org/" class="icons-header" alt="Le forum"><i class="far fa-comments fa-lg"></i></a></li>
                                        <li><a href="#contact" class="icons-header" alt="Email"><i class="far fa-envelope fa-lg"></i></a></li>
                                        
									</ul>
								</header>


                        <!-- Content -->
								<section>
									<header class="main">
										<h1>S'enregistrer</h1>
                                        <strong>
                                        <font color="red">
                                        <?php if(isset($erreurinscription))
                                        {
                                            echo $erreurinscription;
                                        } ?>
                                        </font>
                                        <font color="green">
                                        <?php if(isset($victoryinscription))
                                        {
                                            echo $victoryinscription;
                                        } ?>
                                        </font>
                                        </strong>
                                        <br/>
                                        <br/>
									</header>

									<form method="post">
                                        <div class="row gtr-uniform">
                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="prenom" id="prenom" value="" placeholder="Votre prénom" />
                                            </div>
                                            <br/>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="nom" id="nom" value="" placeholder="Votre nom" />
                                            </div>
                                            <br/>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="mail" id="mail" value="" placeholder="Email" />
                                            </div>
                                            <br/>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="mail2" id="mail2" value="" placeholder="Confirmation de l'email" />
                                            </div>
                                            <br/>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="password" name="password" id="password" value="" placeholder="Mot de passe" />
                                            </div>
                                            <br/>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="password" name="password2" id="password2" value="" placeholder="Confirmation du mot de passe" />
                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="S'enregistrer" class="primary" name="inscription"/></li>
                                                </ul>
                                            </div>
                                            <div class="col-12">
                                               <a href="connexion.php">Déjà un compte ? Se connecter !</a>
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
                <a href="mode.php" alt="Changer les contrastes"><i class="fas fa-low-vision fa-2x"></i></a>
                &emsp;
                <a href="https://twitter.com/handyopensource" class="icons" alt="Twitter"><i class="fab fa-twitter-square fa-2x"></i></a>
                <a href="https://www.facebook.com/Handyopensource" class="icons" alt="Facebbok"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="https://discord.gg/zG7g8cU" class="icons" alt="discord"><i class="fab fa-discord fa-2x"></i></a>
                <a href="https://www.forum.dvkbuntu.org/" class="icons" alt="Le forum"><i class="far fa-comments fa-2x"></i></a>
               <a href="contact.php" class="icons" alt="Email"><i class="far fa-envelope fa-2x"></i></a>
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
} ?>
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

if(isset($_GET['redirect']))
{
    $redirectSecure = intval($_GET['redirect']);
    if($redirectSecure == 321221)
    {
        $victoryconnexion = "Votre compte a bien été activé !";
    }
    elseif($redirectSecure == 9753792)
    {
        $erreurinscription = "L'id ne correspond à aucun compte !";
    }
    elseif($redirectSecure == 3863212)
    {
        $erreurinscription = "URL de confirmation invalide !";
    }
    elseif($redirectSecure == 45672182)
    {
        $victoryinscription = "Votre compte a été créé avec succès. Un email vous a été envoyé, merci de vérifier votre boîte email.";
    }
    else
    {
        header('Location: connexion.php');
    }
}


if(isset($_POST['connexion']))
{
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passconnect = sha1($_POST['passconnect']);
    
    if(!empty($emailconnect) AND !empty($passconnect))
    {
        $emailconnectlenght = strlen($emailconnect);
        
        if($emailconnectlenght <= 255)
        {
            $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ? AND motdepasse = ?');
            $requser->execute(array($emailconnect, $passconnect));
            $userexist = $requser->rowCount();

            if($userexist == 1)
            {
                $userinfo = $requser->fetch();
                if($userinfo['confirmer'] == 1)
                {
                    if(isset($_POST['remember']))
                    {
                        if($_POST['remember'] == "on")
                        {
                            $cookiekey = "";
                            for($i=0;$i<15;$i++)
                            {
                                $cookiekey .= mt_rand(0,9);
                            }
                            
                            $reqcookie = $bdd->prepare('UPDATE utilisateurs SET confirmcookie = ? WHERE email = ?');
                            $reqcookie->execute(array($cookiekey, $userinfo['email']));

                            setcookie('id', $userinfo['id'], time() + 7*24*3600, null, null, false, true);
                            setcookie('email', $userinfo['email'], time() + 7*24*3600, null, null, false, true);
                            setcookie('confirmcookie', $cookiekey, time() + 7*24*3600, null, null, false, true);
                        }
                    }
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['nom'] = $userinfo['nom'];
                    $_SESSION['email'] = $userinfo['email'];
                    $_SESSION['admin'] = $userinfo['admin'];
                    $_SESSION['auteur_actu'] = $userinfo['auteur_actu'];
                    $_SESSION['auteur_doc'] = $userinfo['auteur_doc'];

                    $victoryconnexion = "Connexion réussie !";
                    header("location: index.php");
                }
                else
                {
                    $erreurconnexion = "Vous devez d'abord activer votre compte. Veuillez consulter votre boîte email!";
                }  //fin de la 5eme condition
            }
            else
            {
                $erreurconnexion = "Email et/ou mot de passe incorrect";
            }  //fin de la 4eme condition
        }
        else
        {
            $erreurconnexion = "Email ou mot de passe trop long !";
        }   //fin de la 3eme condition
    }
    else
    {
        $erreurconnexion = "Tous les champs doivent être complétés !";
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
                                       <li><a href="mode.phpid=5" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Se connecter</h1>
                                        <strong>
                                        <font color="red">
                                        <?php if(isset($erreurconnexion))
                                        {
                                            echo $erreurconnexion;
                                        } ?>
                                        </font>
                                        <font color="green">
                                        <?php if(isset($victoryconnexion))
                                        {
                                            echo $victoryconnexion;
                                        } ?>
                                        </font>
                                        </strong>
                                        <br/>
                                        <br/>
									</header>

									<form method="post" action="#">
                                        <div class="row gtr-uniform">
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="emailconnect" id="email" value="" placeholder="Email" />
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="password" name="passconnect" id="pass" value="" placeholder="Mot de passe" />
                                            </div>
                                            <div class="col-6 col-12-small">
                                                <input type="checkbox" id="remember" name="remember">
                                                <label for="remember">Se souvenir de moi</label>
                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Se connecter" class="primary" name="connexion"/></li>
                                                </ul>
                                            </div>
                                            
                                            <div class="col-12">
                                               <a href="register.php">Pas de compte ? S'enregistrer !</a>
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
                <a href="mode.php?id=5" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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
?>
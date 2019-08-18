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
    if($_SESSION['auteur_actu'] == 1 OR $_SESSION['admin'] == 1)
    { 
        if(isset($_POST['envoi']))
        {
            if(isset($_POST['titre']) AND !empty($_POST['titre']) AND isset($_POST['texte']) AND !empty($_POST['texte']))
            {
                $_SESSION['titre'] = htmlspecialchars($_POST['titre']);
                $texte_demo = $_POST['texte'];
                $_SESSION['texte'] = htmlspecialchars($_POST['texte']);
            
?>
<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>DVKBuntu - Ajouter actualité</title>
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
                                       <li><a href="mode.php?id=17" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
                                    <h1><strong>PREVIEW :</strong></h1>
                                    
                                    <h2><u><?php echo $_SESSION['titre']; ?></u></h2>
                                    <h6 style="color: darkgrey;"><i>Ecrit par <?php echo $_SESSION['nom']; ?> (relu par un administrateur)</i></h6>

                                    <br/>
                                    <span class="image main"><center><a href="#image"><i>Votre image sera ici</i></a></center></span>
                                    <br/>

                                    <p><?php echo $texte_demo; ?></p>
                                    <hr/>
                                    <form method="post" action="enregistrer_actu.php" enctype="multipart/form-data">
                                    <div class="col-6 col-12-xsmall" id="image">
                                        <!-- On limite le fichier à 10Mo -->
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                                        <label for="couverture"><i>(Optionnel) </i>Image de couverture :</label><input id="couverture" type="file" name="couverture" file="<?php if(isset($_POST['couverture'])) { echo  $_POST['texte'];} ?>" >
                                    </div>
                                    <br/>
                                        <button type="submit" name="enregistrer">Enregistrer</button>
                                    </form>
                                </section>
						</div>
					</div>

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
                header('Location: add_actu.php');
            } //fin 4eme condition
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

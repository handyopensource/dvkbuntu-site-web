<?php
session_start();

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
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
		<title>DVKBuntu - Contact</title>
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
                                       <li><a href="mode.php?id=6" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
                                        <li><a href="https://twitter.com/handyopensource" class="icons-header" alt="Twitter"><i class="fab fa-twitter-square fa-lg"></i></a></li>
                                        <li><a href="https://www.facebook.com/Handyopensource" class="icons-header" alt="Facebbok"><i class="fab fa-facebook fa-lg"></i></a></li>
                                        <li><a href="https://discord.gg/zG7g8cU" class="icons-header" alt="discord"><i class="fab fa-discord fa-lg"></i></a></li>
                                        <li><a href="https://www.forum.dvkbuntu.org/" class="icons-header" alt="Le forum"><i class="far fa-comments fa-lg"></i></a></li>
                                        <li><a href="#contact" class="icons-header" alt="Email"><i class="far fa-envelope fa-lg"></i></a></li>
                                       <li> <a href="donnation.php" class="icons-header" alt="Email" class="icons"><i class="fas fa-hand-holding-usd fa-lg"></i></a></li>
                                        
									</ul>
								</header>

                        <!-- Section -->
								<section id="contact">
									<header class="major">
										<h2>Votre avis compte</h2>
									</header>
									<p> Vous disposez d'un droit de rétractation, envoyez nous un message et nous supprimerons l'ensemble des informations vous concernant.</p>
                                    <?php if(isset($_GET['k']) AND $_GET['k'] == 678997)
                                    { ?>
                                        <strong><font color="green">Mail envoyé !</font></strong>
                                    <?php } ?>

                                    <form method="post" action="mail.php">
                                        <div class="row gtr-uniform">
                                            <?php if(isset($_SESSION['id']))
                                            {?>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="name-mail" id="demo-name" value="<?php echo $_SESSION['nom']; ?>" placeholder="<?php echo $_SESSION['nom']; ?>" readOnly="true"/>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="email-mail" id="email-name" value="<?php echo $_SESSION['email']; ?>" placeholder="<?php echo $_SESSION['email']; ?>" readOnly="true"/>
                                            </div>
                                            <?php } else { ?>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="name-mail" id="demo-name" value="" placeholder="Nom" required/>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="email" name="email-mail" id="demo-email" value="" placeholder="Email" required/>
                                            </div>
                                           <?php } ?>
                                            
                                            <!-- Break -->
                                            <div class="col-12">
                                                <textarea name="message-mail" id="demo-message" placeholder="Tapez votre message" rows="6" required></textarea>
                                            </div>
                                            <!-- Break -->
                                            <div class="col-6 col-12-small">
                                                <input type="checkbox" id="demo-copy" name="copy-mail" >
                                                <label for="demo-copy">M'envoyer une copie</label>
                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Envoyer un mail" class="primary" name="envoi-mail"/></li>
                                                    <li><input type="reset" value="Reset" /></li>
                                                </ul>
                                            </div>
                                            <strong>
                                            <font color="green">
                                            <?php 
                                            if(isset($_GET['k']) AND $_GET['k'] == 678997)
                                            {
                                                echo "Votre mail a bien été envoyé !";
                                            }
                                            ?>
                                            </font>
                                            </strong>
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
                <a href="mode.php?id=6" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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
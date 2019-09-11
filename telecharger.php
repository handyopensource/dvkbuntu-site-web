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
		<title>DVKBuntu - Télécharger</title>
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
                                       <li><a href="mode.php?id=19" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php?id=19" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Télécharger</h1>
                                        
									</header>

									<p>DVKBuntu est disponible en image ISO pour architecture 64 bits. Téléchargez là dès maintenant ! <br/>
                                    Nombre de téléchargements par semaine : <a href="https://sourceforge.net/projects/dvkbuntu/files/latest/download" onClick="alert('Si vous aimez notre projet, soutenez-nous dans la rubrique Donnation, merci !');"><img alt="Download DVKBuntu" src="https://img.shields.io/sourceforge/dw/dvkbuntu.svg" ></a>
                                    <br/>
                                    Nombre de téléchargements totaux : <a href="https://sourceforge.net/projects/dvkbuntu/files/latest/download" onClick="alert('Si vous aimez notre projet, soutenez-nous dans la rubrique Donnation, merci !');"><img alt="Download DVKBuntu" src="https://img.shields.io/sourceforge/dt/dvkbuntu.svg" ></a>
                                    <br/>
                                    <center><a href="https://sourceforge.net/projects/dvkbuntu/files/latest/download" onClick="alert('Si vous aimez notre projet, soutenez-nous dans la rubrique Donnation, merci !');"><img alt="Download DVKBuntu" src="https://a.fsdn.com/con/app/sf-download-button" width=276 height=48 srcset="https://a.fsdn.com/con/app/sf-download-button?button_size=2x 2x"></a></center>
                                    
                                    </p>
								</section>
                                <section>
                                    <header class="main">
                                        <h1>Comment installer DVKBuntu ?</h1>
                                        <h2><i>Au moindre problèmes, n'hésitez pas à nous contactez via le forum ou le discord !</i></h2>
                                    </header>
                                    <ol>
                                        <li>Commencez par vous munir d'une clé USB ou d'un CD (nous recommandons plutôt la clé USB) d'au moins 4Go.</li>
                                        <li>Téléchargez l'image ISO de DVKBuntu ci-dessus.</li>
                                        <li>Téléchargez un fichier de gravure : <a href="https://rufus.ie">Rufus (seulement Windows)</a> ou <a href="https://www.balena.io/etcher/">Etcher</a> sont deux outils très performant, mais il en existe plein d'autre.</li>
                                        <li>Sélectionez votre clé (ou disque) comme périphérique, et l'image ISO que vous venez de télécharger comme fichier de démarrage (dans Rufus, cliquez sur "sélectionner". <i>Voir capture ci-dessous</i>)</li>
                                        <br/> <center><img alt="" src="images/rufus.png" width="40%"/></center>
                                        <li>Appuyez sur "Démarrer".</li>
                                        <li>Une fois votre périphérique prêt, éteignez l'ordinateur où vous souhaitez installer DVKBuntu et insérez-y la clé (ou le disque).</li>
                                        <li>Il va vous falloir changer l'ordre de démarrage de votre pc, soit en passant par le BIOS soit par le "menu de démarrage" (plus simple). La méthode varie selon le pc, mais de manière générale il faut presser une des touches suivantes au tout début du démarrage de l'ordinateur : <strong>F9,F10,F11,F12,DELETE</strong>. Choississez de démarrer sur votre périphérique.</li>
                                        <li>Une fois sur le menu DVKBuntu, choississez votre langue et sélectionner "Installer".</li>
                                        <li>Suivez les instructions qui s'affichent à l'écran.</li>
                                    </ol>

                                </section>

						</div>
					</div>

				  <!-- Sidebar -->
					<?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php?id=19" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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
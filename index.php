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
		<title>DVKBuntu - Accueil</title>
		<meta charset="utf-8" />
        <link rel="icon" type="image/png" href="images/LogoGenerale.png" />	
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <?php
        if($_SESSION['mode'] == "sombre")
        {?>
		  <link rel="stylesheet" href="assets/css/main.css" />
        <?php }
        else
        { ?>
            <link rel="stylesheet" href="assets/css/main_clair.css" />
        <?php } ?>
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
                                       <li> <a href="donnation.php" class="icons-header" alt="Email" class="icons"><i class="fas fa-hand-holding-usd fa-lg"></i></a></li>
                                        
									</ul>
								</header>


							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Projet Handy opensource </h1><br/>
											<h2>Pour déficient visuel &amp; moteur</h2>
											<p>L'informatique pour tous</p>
										</header>
										<p>
                                            Nous vivons une époque ou l'informatique fait partie intégrante de
                                            notre vie personnelle et professionnelle. <br/>
                                            Aujourd'hui, force est de constater que tous ne sont pas égaux dans l'utilisation de
                                            l’outil informatique. <br/>
                                            Notre objectif :
                                            Permettre à toutes personnes en situation d'HandiCap d'accéder à l'informatique.<br/>
                                            <br/>
                                        <i>Appuyez sur <a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a> pour changer les contrastes.</i></p>
										<ul class="actions">
											<li><a href="http://www.global-informatique-securite.com/2019/04/2019/04/dvkbuntu-un-projet-os-linux-pour-le-monde-de-l-handicap.html" class="button big">En savoir plus</a></li>
                                            
										</ul>
									</div>
                                    <?php if($_SESSION["mode"] == "sombre")
                                    { ?>
                                        <img src="images/logo.png" alt="" class="logo_home"/>
                                    <?php }
                                    else
                                    { ?>
										<img src="images/logo_clair.png" alt="" class="logo_home"/>
                                    <?php } ?>
								</section>
                            
                            <!-- Section -->
								<section id="info">
									<header class="major">
										<h2>Ce que nous vous proposons !</h2>
                                        <p>Nous sommes une équipe de plusieurs bénovoles passionnés de nouvelles technologies.<br/>
                                            Découvrez notre Projet !</p>
									</header>
                                    
                                    <!-- SLIDESHOW -->
                                    <div align="center">
                                        <img class="mySlides" src="images/gallery/2.jpeg" width="100%">
                                        <img class="mySlides" src="images/gallery/3.jpeg" width="100%">
                                        <img class="mySlides" src="images/gallery/4.jpeg" width="100%">
                                        <img class="mySlides" src="images/gallery/5.jpeg" width="100%">
                                        <img class="mySlides" src="images/gallery/6.jpeg" width="100%">
                                        <img class="mySlides" src="images/gallery/7.jpeg" width="100%">
                                        <img class="mySlides" src="images/gallery/8.jpeg" width="100%">
                                    </div>
                                    
                                    <script>
                                        var slideIndex = 0;
                                        carousel();

                                        function carousel() {
                                          var i;
                                          var x = document.getElementsByClassName("mySlides");
                                          for (i = 0; i < x.length; i++) {
                                            x[i].style.display = "none";
                                          }
                                          slideIndex++;
                                          if (slideIndex > x.length) {slideIndex = 1}
                                          x[slideIndex-1].style.display = "block";
                                          setTimeout(carousel, 4000); // Change image every 2 seconds
                                        }
                                    </script>
                                    <br/>
                                    
									<div class="posts" id="description">
                                        
										<article>
											<center><a href="#" class="image"><img src="images/LinuxOpenSource.png" alt="" /></a></center>
											<h3>Une distribution</h3>
											<p>DVKBUNTU n'est pas une énième Distribution Gnu/Linux Elle est basé sur un OS libre opensource, « Kubuntu » Modifié , Adapté, Optimisé pour les personnes en situation d'HandiCap divers...</p>
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/Support.png" alt="" /></a></center>
											<h3>Support au travers d'un forum et de discord</h3>
                                            <p>Voici le <a href="https://www.forum.dvkbuntu.org/" alt="Le forum">lien</a> vers le forum, <a href="https://discord.gg/zG7g8cU" alt="discord">lien</a> vers le Discord Handy Open Source.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/ISO.png" alt="" /></a></center>
											<h3> DVKBuntu est disponible sous forme d'une ISO</h3>
											<p>Cette ISO est en cours de modification, de personnalisation agrémenté d'outils, et  adapté à une meilleure prise en main a destination des personnes touchées par un handicap moteur , visuel, sensoriel... </p>
											
										</article>
                                    </div>
                            </section>

							
							<!-- Section -->
								<section>
									<header class="major">
										<h2>Une équipe, un projet !</h2>
									</header>
									<div class="posts" id="equipe">
										<article>
											<center><a href="#" class="image"><img src="images/Jacky.gif" alt="" /></a></center>
											<h3>Jacky</h3>
											<p>Initiateur du projet, passionné d'informatique et lui-même victime d'un handicap, il a voulu créer un moyen d'accès à l'informatique pour les personnes en situation de handicap et ainsi le projet DVKBuntu est né.</p>
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/PaulluxWaffle.png" alt="" /></a></center>
											<h3>💻 - PaulluxWaffle - ⌨</h3>
											<p>Fan d'informatique et développeur du projet, il a pas mal travaillé pour nous proposer une interface visuelle mieux adaptée. Il gère les mises à jour du projet. Il a développé le site web et le forum.  Lui-même très impliqué dans le projet.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/Yo_Man.png" alt="" /></a></center>
											<h3>Yo_man🌴</h3>
											<p>Fan d'informatique et de sécurité d'informatique, il a pas mal travaillé pour nous proposer un noyau plus performant, le noyau XanMod et sa personnalisation. Il a participé à l'élaboration du forum. Il est une des personnes le plus impliqué dans le projet.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/Toulibre.png" alt="" /></a></center>
											<h3>Toulibre</h3>
											<p>Fan d'informatique et designer du projet, il a créé des fonds d'écran, des logos, et il est une des personnes qui ont développé des paquets logiciels pour ses créations.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/Chris2228.png" alt="" /></a></center>
											<h3>Chriss2228</h3>
											<p>Fan d'informatique et devenu progressivement développeur du projet, il a commencé comme bêta testeur du projet, puis grâce à son implication, il a pu devenir créateur des iso puis développeur.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/ADN.png" alt="" /></a></center>
											<h3>ΔĐИ</h3>
											<p>Fan d'informatique et créateur de la page web d'acceuil dans Chromium. ΔĐИ s'intéresse aussi à la sécurité informatique.</p>
											
										</article>
                                        <article>
											<center><a href="#" class="image"><img src="images/rodrigem.png" alt="" /></a></center>
											<h3>Rodriguem7973</h3>
											<p>Rodriguem7973 est très impliqué dans le discord, très souvent connecté, il participe à l'acceuil des nouveaux dans le projet, fait aussi régulièrement de la publicité pour le projet sur Facebook principalement.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/noralex.png" alt="" /></a></center>
											<h3>noralexx</h3>
											<p>Noralexx est présente de temps en temps sur le discord et a fait pas mal de pubs sur les réseaux sociaux notamment Twitter.</p>
											
										</article>
										<article>
											<center><a href="#" class="image"><img src="images/AutreContributeur.png" alt="" /></a></center>
											<h3>GillesDC et tous les autres...</h3>
											<p>GillesDC est le principal développeur du site web. Et merci aussi à tout les autres qui ont contribué.</p>
											
										</article>
									</div>
								</section>
                                <hr>
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
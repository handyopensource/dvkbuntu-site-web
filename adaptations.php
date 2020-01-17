<?php
session_start();

include 'header.php'; 
    
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
		<title>DVKBuntu - Adaptations</title>
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
        <link rel="stylesheet" href="assets/css/slideshow.css" />

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
                                       <li><a href="mode.php?id=1" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Adaptations aux personnes en situation d'handicap</h1>
									</header>
                                    <!-- Slideshow container -->
                                    <div class="slideshow-container">

                                        <!-- Full-width images with number and caption text -->
                                        <div class="mySlides fade">
                                        <div class="numbertext">1 / 3</div>
                                        <video src="videos/Changement%20Facteur%20d'%C3%A9chelle.webm" controls poster="images/logo.png" width="100%">Your browser does not support the video tag.</video>
                                        <div class="text">Changement du facteur d'échelle</div>
                                        </div>

                                        <div class="mySlides fade">
                                        <div class="numbertext">2 / 3</div>
                                        <video src="videos/Fonctionnement%20du%20menu%20Accueil%20DVKbuntu.webm" controls poster="images/logo.png" width="100%">Your browser does not support the video tag.</video>
                                        <div class="text">Fonctionnement du menu d'accueil</div>
                                        </div>
                                        <div class="mySlides fade">
                                        <div class="numbertext">3 / 3</div>
                                        <video src="videos/Simple%20Menu.webm" controls poster="images/logo.png" width="100%" >Your browser does not support the video tag.</video>
                                        <div class="text">Menu simple</div>
                                        </div>

                                        <!-- Next and previous buttons -->
                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                        </div>
                                        <br>

                                        <!-- The dots/circles -->
                                        <div style="text-align:center">
                                        <span class="dot" onclick="currentSlide(1)"></span>
                                        <span class="dot" onclick="currentSlide(2)"></span>
                                        <span class="dot" onclick="currentSlide(3)"></span>
                                    </div>
                                    <script>
                                        var slideIndex = 1;
                                        showSlides(slideIndex);

                                        // Next/previous controls
                                        function plusSlides(n) {
                                        showSlides(slideIndex += n);
                                        }

                                        // Thumbnail image controls
                                        function currentSlide(n) {
                                        showSlides(slideIndex = n);
                                        }

                                        function showSlides(n) {
                                        var i;
                                        var slides = document.getElementsByClassName("mySlides");
                                        var dots = document.getElementsByClassName("dot");
                                        if (n > slides.length) {slideIndex = 1}
                                        if (n < 1) {slideIndex = slides.length}
                                        for (i = 0; i < slides.length; i++) {
                                          slides[i].style.display = "none";
                                        }
                                        for (i = 0; i < dots.length; i++) {
                                          dots[i].className = dots[i].className.replace(" active", "");
                                        }
                                        slides[slideIndex-1].style.display = "block";
                                        dots[slideIndex-1].className += " active";
                                        }
                                    </script>
								    <p>
                                    DVKBuntu a été conçu pour répondre au mieux au besoin des personnes en situation d'handicap. Voici un résumé de ce qui a été mis en place par notre équipe. <br/>
                                    <br/>
                                        Tout d'abord, le <strong>thème à un contraste élevé</strong>, mieux adaptés aux personnes malvoyantes.<br/>
                                    Dans la même optique, le système a un facteur d'échelle plus important (<strong>le système est "zoomé"</strong>) par défaut. Pour ceux qui n'en ont pas besoin, il est réglable par la suite. <br/>
                                    Le système utilise la <strong>police d'écriture "<a href="http://www.luciole-vision.com/luciole-en.html">Luciole</a>"</strong>, créée pour être la plus lisible possible. <br/>
                                    <center><img src="images/Police_Luciole.png" alt="" width="70%"/></center>
                                    Le <strong>menu d'accueil a été simplifié</strong> et est très simple à prendre en main. Il contient :
                                    </p>
                                    <ul>
					<li>Lien vers votre navigateur web (celui définit par défaut)</li>	
                                        <li>Lien vers notre site web</li>
                                        <li>Lien vers notre forum</li>
                                        <li>Lien vers notre discord</li>
                                        <li>Lien vers Kmag (loupe pour les malvoyants)</li>
                                        <li>Lien vers les paramètres d'accessibilité (lecture d'écran, cloche visuelle, sonore, etc.)</li>
                                        <li>Bouton Eteindre/Déconnection/Redémarrer gros et faciles d'accès</li>
                                        <li>Curseur pour le choix du facteur d'échelle (zoom)</li>
                                    </ul>
                                    <center><img src="images/menu_dacceuil.png" alt="" width="70%"/></center>
                                    <br/>
                                    <p>
                                    La distribution a aussi <strong>un menu système simple</strong> pour les utilisateurs un peu plus avancé (à la place du menu de kde par défaut).
                                    <center><img src="images/simple_menu.png" alt="" width="70%"/></center>
                                    <br/>
                                    La page d'accueil et les paramètres par défaut du navigateur (Chromium) sont adaptés aux personnes malvoyantes. <br/>
                                    <center><img src="images/page_dacceuil_sur_chromium.png" alt="" width="70%"/></center>
                                    Les icônes de la zone de notifications peuvent s'agrandir autant que demandé en redimensionnant la barre système en bas de l'écran. <br/>
                                    Le système propose même <strong>ses propres fonds d'écrans</strong>, <strong>son propre logo</strong> ainsi que <strong>son propre screenfetch et neofetch</strong>! 
                                    <center><img src="images/screenfetch_et_neofetch.png" alt="" width="70%"/></center>
                                    L'installateur (Ubiquity) et son "slideshows" ont leurs polices de charactère agrandies pour permettre aux malvoyants d'installer seuls la distribution. <br/>
                                    La distribution est équipée d'<strong>un noyau Linux Xanmod</strong> que nous avons optimisé pour les ordinateurs personnels (et pas pour les serveurs). <br/>
                                    DVKBuntu offre un <strong>Kinfoservice personnalisé</strong>, ainsi qu'un <strong>thème Plymouth personnalisé</strong> (logo au démarrage et à l'arrêt du système).
                                    <br/>
                                    <br/>
                                    <img src="images/kinfocenter.png" alt="" width="48%"/>
                                    <img src="images/ecran_dacceuil.png" alt="" width="48%"/>
                                    </p>
                                    
                                </section>
						</div>
					</div>

				 <!-- Sidebar -->
					<?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php?id=1" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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

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
		<title>DVKBuntu - Open Source</title>
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
                                       <li><a href="mode.php?id=20" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php?id=19" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Open Source</h1>
                                        
									</header>

									<p>Handy OpenSource vous propose des solutions libres et open source, le logiciel libre vient s’opposer aux logiciels propriétaires qui imposent des limitations de licences aux utilisateurs. L’objectif du libre est d’offrir plus de libertés aux utilisateurs individuels ou en collectivités quant à l’utilisation des logiciels. Les utilisateurs de logiciels libres doivent avoir la liberté d'exécuter, copier, distribuer, étudier, modifier et améliorer le logiciel. <br/>
                                    <br/>
                                    Tout en respectant ces valeurs, nous voulons garantir à tous l'accès à l'informatique. <br/>
                                    <br/>
                                    Afin d'y arriver, vous trouverez la liste de liens suivante qui présente les sources des modifications que nous vous proposons :<br/>
                                    <br/>
                                    
                                    </p>
                                    <table style="width: 100%">
                                    <tr>
                                        <th>Le framagit de notre projet</th>
                                        <th>La page Launchpad de l'équipe</th>
                                        <th>La page du projet sur Launchpad</th>
                                        <th>Le PPA du projet sur Launchpad</th>
                                    </tr>
                                    <tr>
                                        <td><img src="images/framagit.png" alt=""/></td>
                                        <td><img src="images/launchpad.png" alt=""/></td>
                                        <td><img src="images/launchpad_2.png" alt=""/></td>
                                        <td><img src="images/LogoGenerale.png" alt=""/></td>
                                    </tr>
                                    <tr>
                                        <td><center><a href="https://framagit.org/groups/handy-open-source/-/shared">framagit.org</a></center></td>
                                        <td><center><a href="https://launchpad.net/~dvkbuntu">launchpad.net</a></center></td>
                                        <td><center><a href="https://launchpad.net/dvkbuntu">launchpad.net</a></center></td>
                                        <td><center><a href="https://launchpad.net/~dvkbuntu/+archive/ubuntu/dvkbuntu-ppa">launchpad.net</a></center></td>
                                    </tr>
                                    </table>
								</section>
                                
						</div>
					</div>

				  <!-- Sidebar -->
					<?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php?id=20" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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
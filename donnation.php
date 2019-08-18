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
		<title>DVKBuntu - Donnation</title>
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
                                       <li><a href="mode.php?id=8" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Donnation</h1>
                                        <h3>Merci de votre participation !</h3>
                                        <iframe id="haWidget" allowtransparency="true" scrolling="auto" src="https://www.helloasso.com/associations/handyopensource/formulaires/1/widget" style="width:100%;height:750px;border:none;" onload="window.scroll(0, this.offsetTop)"></iframe>

                                <iframe id="haWidget" allowtransparency="true" src="https://www.helloasso.com/associations/handyopensource/formulaires/1/widget-bouton" style="width:100%;height:70px;border:none;"></iframe><div style="width:100%;text-align:center;">Propulsé par <a href="https://www.helloasso.com/" rel="nofollow">HelloAsso</a></div>
									</header>

									<?php if(isset($_GET['redirect']) AND $_GET['redirect'] == 23344)
                                    { ?>
                                    <button class="button big"><a href="https://sourceforge.net/projects/dvkbuntu/files/latest/download">TELECHARGER</a> </button>
                                    <?php } ?>
								</section>

						</div>
					</div>

				<!-- Sidebar -->
					<?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php?id=8" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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

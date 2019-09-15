<?php

session_start();

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}
if(isset($_GET['tri']) AND isset($_GET['tri_user']))
{
    $tri = htmlspecialchars($_GET['tri']);
    $tri_user = htmlspecialchars($_GET['tri_user']);
}
else
{
    header('Location: list_doc.php?tri=id&tri_user=id');
}

include 'header.php';

?>

<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>DVKBuntu - Actualités</title>
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
                                       <li><a href="mode.php?id=14" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php?id=14" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Documentation (Tutoriaux)</h1>
									</header>
                                    <table>
                                        
                                        <?php
                                            if($tri == "auteur")
                                            {
                                                $reponse = $bdd->query('SELECT * FROM documents ORDER BY auteur');
                                            }
                                            elseif($tri == "titre")
                                            {
                                                $reponse = $bdd->query('SELECT * FROM documents ORDER BY titre');
                                            }
                                            else
                                            {
                                                $reponse = $bdd->query('SELECT * FROM documents ORDER BY id');
                                            }

                                            $actuExist = $reponse->rowCount();

                                            if($actuExist == 0)
                                            {
                                                echo "Aucune documentation pour le moment. Revenez plus tard!";
                                            }
                                            else
                                            {?>
                                                <tr>
                                                    <th><a href="list_doc.php?tri=auteur&tri_user=<?php echo $tri_user; ?>">Auteur</a></th>
                                                    <th><a href="list_doc.php?tri=titre&tri_user=<?php echo $tri_user; ?>">Titre</a></th>
                                                    <th>Voir plus</th>
                                                </tr>
                                                <?php
                                                // On affiche chaque entrée une à une
                                                while ($donnees = $reponse->fetch())
                                                { ?>

                                                    <tr>
                                                        <td><?php echo $donnees['auteur']; ?></td>
                                                        <td><?php echo $donnees['titre']; ?></td>
                                                        <td><a href="doc.php?id=<?php echo $donnees['id']; ?>">Voir plus</a></td>
                                                    </tr>

                                                <?php
                                                }
                                            }

                                            $reponse->closeCursor(); // Termine le traitement de la requête

                                        ?>
                                    </table>
                                        
								</section>

						</div>
					</div>
                
                <?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php?id=14" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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

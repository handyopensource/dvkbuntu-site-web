<?php
session_start();

include 'header.php'; 

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}

if(isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
{ 

if(isset($_GET['tri']))
{
    $tri = htmlspecialchars($_GET['tri']);
}
else
{
    header('Location: gestion.php?tri=id');
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
		<title>DVKBuntu - Gestion</title>
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
                                       <li><a href="mode.php?id=12" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php?id=12" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Gestion</h1>
                                        <strong>
                                        <font color="red">
                                        <?php if(isset($erreur))
                                        {
                                            echo $erreur;
                                        } ?>
                                        </font>
                                        <font color="green">
                                        <?php if(isset($victory))
                                        {
                                            echo $victory;
                                        } ?>
                                        </font>
                                        </strong>
                                        <br/>
                                        <br/>
									</header>
                                    
                                    <h2>Actualités :</h2>
                                    <table>
                                    <tr>
                                        <th><a href="gestion.php?tri=id">ID</a></th>
                                        <th><a href="gestion.php?tri=auteur">Auteur</a></th>
                                        <th><a href="gestion.php?tri=titre">Titre</a></th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Valider</th>
                                        <th>Supprimer</th>
                                    </tr>
                                    <?php
                                        if($tri == "auteur")
                                        {
                                            $reponse = $bdd->query('SELECT * FROM actualites ORDER BY auteur');
                                        }
                                        elseif($tri == "titre")
                                        {
                                            $reponse = $bdd->query('SELECT * FROM actualites ORDER BY titre');
                                        }
                                        else
                                        {
                                            $reponse = $bdd->query('SELECT * FROM actualites ORDER BY id');
                                        }
                                            
                                        $actuExist = $reponse->rowCount();
                                    
                                        if($actuExist == 0)
                                        {
                                            echo "Aucune actualité pour le moment. Revenez plus tard!";
                                        }
                                        else
                                        {
                                            // On affiche chaque entrée une à une
                                            while ($donnees = $reponse->fetch())
                                            { ?>
                                                
                                                <tr>
                                                    <form method="post">
                                                    <td><input type="hidden" name="id" value="<?php echo $donnees['id']; ?>"/><?php echo $donnees['id']; ?></td>
                                                    <td><?php echo $donnees['auteur']; ?></td>
                                                    <td><input type="text" value="<?php echo $donnees['titre']; ?>" name="titre" readOnly/></td>
                                                    <td><textarea name="description" maxlength="5000" readOnly><?php echo $donnees['description']; ?></textarea></td>

                                                    <td><img alt="" src="images/actus/<?php echo $donnees['image']; ?>" width="60px" height="40px" /></td>
                                                   
                                                    <?php if($donnees['valider'] == 1)
                                                    { ?>
                                                    <td><button class="button-modifier"><a href="modifier_actu.php?id=<?php echo $donnees['id']; ?>">Modifier</a></button></td>
                                                    <?php } else { ?>
                                                    <td><button class="button-valider"><a href="valider_actu.php?id=<?php echo $donnees['id']; ?>">Valider</a></button></td>
                                                    <?php } ?>
                                                    <td><button type="submit" class="button-supprimer"><a href="suppression_actu.php?id=<?php echo $donnees['id']; ?>" style="color: red;">Supprimer</a></button></td>
                                                    </form>
                                                </tr>
                                                
                                            <?php
                                            }
                                        }

                                        $reponse->closeCursor(); // Termine le traitement de la requête
                                    
                                    ?>
                                    </table>
                                    <br/>
                                    <hr class="major" />
                                    
                                    <h2>Documentation :</h2>
									<table>
                                    <tr>
                                        <th><a href="gestion.php?tri=id">ID</a></th>
                                        <th><a href="gestion.php?tri=auteur">Auteur</a></th>
                                        <th><a href="gestion.php?tri=titre">Titre</a></th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Valider</th>
                                        <th>Supprimer</th>
                                    </tr>
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
                                        {
                                            // On affiche chaque entrée une à une
                                            while ($donnees = $reponse->fetch())
                                            { ?>
                                                
                                                <tr>
                                                    <form method="post">
                                                    <td><input type="hidden" name="id" value="<?php echo $donnees['id']; ?>"/><?php echo $donnees['id']; ?></td>
                                                    <td><?php echo $donnees['auteur']; ?></td>
                                                    <td><input type="text" size="5" value="<?php echo $donnees['titre']; ?>" name="titre" readOnly/></td>
                                                    <td><textarea name="description" maxlength="5000" cols="6" readOnly><?php echo $donnees['description']; ?></textarea></td>
                                                    
                                                    <?php if(!empty($donnees['image']))
                                                    { ?>
                                                    <td><img alt="" src="images/docs/<?php echo $donnees['image']; ?>" width="60px" height="40px" /></td>
                                                    <?php } else { ?>
                                                    <td>/</td>
                                                    <?php } ?>
                                                   
                                                    <?php if($donnees['valider'] == 1)
                                                    { ?>
                                                    <td><button class="button-modifier"><a href="modifier_doc.php?id=<?php echo $donnees['id']; ?>">Modifier</a></button></td>
                                                    <?php } else { ?>
                                                    <td><button class="button-valider"><a href="valider_doc.php?id=<?php echo $donnees['id']; ?>">Valider</a></button></td>
                                                    <?php } ?>
                                                    <td><button type="submit" class="button-supprimer"><a href="suppression_doc.php?id=<?php echo $donnees['id']; ?>" style="color: red;">Supprimer</a></button></td>
                                                    </form>
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
                <a href="mode.php?id=12" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
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
<?php }
elseif(isset($_COOKIE['id']) AND isset($_COOKIE['email']) AND isset($_COOKIE['confirmcookie']))
{
    header('Location: cookie.php');
}
else
{
    header('Location: erreur.php');
}
?>
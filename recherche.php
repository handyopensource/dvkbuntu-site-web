<?php
session_start();

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}

include 'header.php'; 

if(isset($_GET['query']) AND !empty($_GET['query']))
{  
    $q = htmlspecialchars($_GET['query']);
    $qLenght = strlen($q);

    if($qLenght < 100)
    {
        $qMin = strtolower($q);
        $qMin = strtr($qMin, 'àáâãäåçèéêëìíîïðòóôõöùúûüýÿ','aaaaaaceeeeiiiioooooouuuuyy'); 
        $q_array = explode(' ', $qMin);
        $qExist = 0;

        foreach ($q_array as $element) 
        {
            $reqSearch = $bdd->query("SELECT * FROM recherche WHERE text LIKE '%$element%'");
            $valeur = $reqSearch->rowCount(); 
            $qExist = $qExist + $valeur;
            
            $reqSiActu = $bdd->query("SELECT * FROM actualites WHERE description LIKE '%$element%' AND valider = 1");
            $valeur2 = $reqSiActu->rowCount(); 
            $qExist = $qExist + $valeur2;
            
            $reqSiDoc = $bdd->query("SELECT * FROM documents WHERE description LIKE '%$element%' AND valider = 1");
            $valeur3 = $reqSiDoc->rowCount(); 
            $qExist = $qExist + $valeur3;
        } ?>

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
                                       <li><a href="mode.php?id=18" style="color: yellow; background-color: black;">Mode malvoyant : </a>&nbsp;<a href="mode.php?id=18" style="color:#000000" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg" id="icone_oeil"></i></a></li>
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
										<h1>Recherche</h1>
									</header>
                                   
                                    <?php
                                        if($qExist == 0)
                                        { ?>
                                            <font color="red">Aucun élement ne correspond à votre recherche !</font>
                                        <?php }
                                        else
                                        {
                                            echo "Voici le(s) endroit(s) où se trouve le(s) mot(s) recherché(s) :";
                                            ?> <ul> <?php
                                            foreach ($q_array as $element) 
                                            {
                                                //recherche dans table "recherche"
                                                $reqSearch2 = $bdd->prepare("SELECT * FROM recherche WHERE text LIKE '%$element%'");
                                                $reqSearch2->execute(array($element));
                                                $valeurSearch = $reqSearch2->rowCount(); 
                                                if($valeurSearch > 0)
                                                {
                                                    $info = $reqSearch2->fetch();
                                                    ?>
                                                    <li><a href="<?php echo $info['url']; ?>" alt="Résultat de la recherche"><?php echo $info['page']; ?></a></li>
                                                <?php }
                                                //recherche dans table "actualites" 
                                                $reqActu2 = $bdd->prepare("SELECT * FROM actualites WHERE description LIKE '%$element%' AND valider = 1");
                                                $reqActu2->execute(array($element));
                                                $valeurActu = $reqActu2->rowCount(); 
                                                if($valeurActu > 0)
                                                {
                                                    $info = $reqActu2->fetch();
                                                    ?>
                                                    <li><a href="actualite.php?id=<?php echo $info['id']; ?>" alt="Résultat de la recherche">Actualite : <?php echo $info['titre']; ?></a></li>
                                                <?php }
                                                //recherche dans table "documents" 
                                                $reqDoc2 = $bdd->prepare("SELECT * FROM documents WHERE description LIKE '%$element%' AND valider = 1");
                                                $reqDoc2->execute(array($element));
                                                $valeurDoc = $reqDoc2->rowCount(); 
                                                if($valeurDoc > 0)
                                                {
                                                    $info = $reqDoc2->fetch();
                                                    ?>
                                                    <li><a href="doc.php?id=<?php echo $info['id']; ?>" alt="Résultat de la recherche">Documentation : <?php echo $info['titre']; ?></a></li>
                                                <?php }
                                            } ?></ul><?php
                                        }
                                        ?>
                            </section>

						</div>
					</div>
                
            <!-- Sidebar -->
					<?php include 'sidebar.html'; ?>
                                                                                                                    
			</div>
            
            <!--Bottom menu -->
            <div class="navbar-bottom">
                <a href="mode.php?id=18" alt="Changer les contrastes"><i class="fas fa-low-vision fa-lg"></i></a>
                &emsp;
                <a href="https://twitter.com/handyopensource" class="icons" alt="Twitter"><i class="fab fa-twitter-square fa-lg"></i></a>
                <a href="https://www.facebook.com/Handyopensource" class="icons" alt="Facebbok"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="https://discord.gg/zG7g8cU" class="icons" alt="discord"><i class="fab fa-discord fa-lg"></i></a>
                <a href="https://www.forum.dvkbuntu.org/" class="icons" alt="Le forum"><i class="far fa-comments fa-lg"></i></a>
               <a href="contact.php" class="icons" alt="Email"><i class="far fa-envelope fa-lg"></i></a>
                <a href="donnation.php" class="icons" alt="Email" class="icons"><i class="fas fa-hand-holding-usd fa-lg"></i></a>
            </div>
        
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
        header('Location: erreur.php');
    }
}
else
{
    header('Location: erreur.php');
}
?>


<?php
session_start();

if(!empty($_SESSION["mode"]))
{}
else
{
    $_SESSION["mode"] = "clair";
}

if(isset($_POST['envoi-form']))
{
    if(isset($_POST['nom']) AND !empty($_POST['nom']) AND isset($_POST['prenom']) AND !empty($_POST['prenom']) AND isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['pays']) AND !empty($_POST['pays']))
    {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $pays = htmlspecialchars($_POST['pays']);

        $nomlength = strlen($nom);
        $prenomlength = strlen($prenom);
        $emaillength = strlen($email);
        $payslenght = strlen($pays);

        if($nomlength <= 255 AND $prenomlength <= 255 AND $emaillength <= 255 AND $payslength <= 255)
        {
            $mail = "comptabilite.handyopensource@dvkbuntu.org";
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }

            //=====Déclaration des messages au format texte et au format HTML.

            $message_html = "<html>
            <head>
            <meta charset=\"utf-8\"/>
            </head>
            <body>
            <center><h1>Demande d'adhésion</h1></center>
            <br/>
            <p>
            Nouvelle demande d'adhésion de <strong>".$prenom." ".$nom."</strong>, son adresse mail est <strong>".$email."</strong> et il vient de : <strong>".$pays."</strong>.
            </p>
            </body>
            </html>";

            //=====Création de la boundary

            $boundary = "-----=".md5(rand());

            //=====Définition du sujet.

            $sujet = "Nouveau message de ".$nom;

            //=====Création du header de l'e-mail.

            $header = "From: ".$prenom." ".$nom." <".$email.">".$passage_ligne;
            $header.= "Reply-to: ".$nom." <".$email.">".$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

            //=====Création du message.

            $message = $passage_ligne."--".$boundary.$passage_ligne;

            //=====Ajout du message au format texte.

            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_txt.$passage_ligne;

            //==========

            $message.= $passage_ligne."--".$boundary.$passage_ligne;

            //=====Ajout du message au format HTML

            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_html.$passage_ligne;

            //==========

            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;

            //=====Envoi de l'e-mail.
            mail($mail,$sujet,$message,$header);
            
            header("location: membre.php?k=678997");
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
		<title>DVKBuntu - Devenir membre</title>
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
										<h2>Devenez membre !</h2>
                                        <?php if(isset($_GET['k']) AND $_GET['k'] == 678997)
                                        { ?>
                                            <strong><h2><font color="green">Mail envoyé !</font></h2></strong>
                                        <?php } ?>
									</header>
                                    <form method="post">
                                        <div class="row gtr-uniform">

                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="nom" id="demo-name" value="" placeholder="Nom" required/>
                                            </div>
                                            <div class="col-6 col-12-xsmall">
                                                <input type="text" name="prenom" id="prenom" value="" placeholder="Prénom" required/>
                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <input type="email" name="email" id="demo-email" value="" placeholder="Email" required/>
                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <select name="pays">
                                                    <option disabled selected>Choisir un pays... </option>

                                                    <option value="Afghanistan">Afghanistan </option>
                                                    <option value="Afrique_Centrale">Afrique Centrale </option>
                                                    <option value="Afrique_du_sud">Afrique du Sud </option>
                                                    <option value="Albanie">Albanie </option>
                                                    <option value="Algerie">Algerie </option>
                                                    <option value="Allemagne">Allemagne </option>
                                                    <option value="Andorre">Andorre </option>
                                                    <option value="Angola">Angola </option>
                                                    <option value="Anguilla">Anguilla </option>
                                                    <option value="Arabie_Saoudite">Arabie saoudite </option>
                                                    <option value="Argentine">Argentine </option>
                                                    <option value="Armenie">Armenie </option>
                                                    <option value="Australie">Australie </option>
                                                    <option value="Autriche">Autriche </option>
                                                    <option value="Azerbaidjan">Azerbaidjan </option>

                                                    <option value="Bahamas">Bahamas </option>
                                                    <option value="Bangladesh">Bangladesh </option>
                                                    <option value="Barbade">Barbade </option>
                                                    <option value="Bahrein">Bahrein </option>
                                                    <option value="Belgique">Belgique </option>
                                                    <option value="Belize">Belize </option>
                                                    <option value="Benin">Benin </option>
                                                    <option value="Bermudes">Bermudes </option>
                                                    <option value="Bielorussie">Biélorussie </option>
                                                    <option value="Bolivie">Bolivie </option>
                                                    <option value="Botswana">Botswana </option>
                                                    <option value="Bhoutan">Bhoutan </option>
                                                    <option value="Boznie_Herzegovine">Boznie-Herzegovine </option>
                                                    <option value="Bresil">Bresil </option>
                                                    <option value="Brunei">Brunei </option>
                                                    <option value="Bulgarie">Bulgarie </option>
                                                    <option value="Burkina_Faso">Burkina Faso </option>
                                                    <option value="Burundi">Burundi </option>

                                                    <option value="Caiman">Caiman </option>
                                                    <option value="Cambodge">Cambodge </option>
                                                    <option value="Cameroun">Cameroun </option>
                                                    <option value="Canada">Canada </option>
                                                    <option value="Canaries">Canaries </option>
                                                    <option value="Cap_vert">Cap-Vert </option>
                                                    <option value="Chili">Chili </option>
                                                    <option value="Chine">Chine </option>
                                                    <option value="Chypre">Chypre </option>
                                                    <option value="Colombie">Colombie </option>
                                                    <option value="Comores">Colombie </option>
                                                    <option value="Congo">Congo </option>
                                                    <option value="Congo_democratique">Congo_democratique </option>
                                                    <option value="Cook">Cook </option>
                                                    <option value="Coree_du_Nord">Corée du Nord </option>
                                                    <option value="Coree_du_Sud">Coree du Sud </option>
                                                    <option value="Costa_Rica">Costa-Rica </option>
                                                    <option value="Cote_d_Ivoire">Côte-d'Ivoire </option>
                                                    <option value="Croatie">Croatie </option>
                                                    <option value="Cuba">Cuba </option>

                                                    <option value="Danemark">Danemark </option>
                                                    <option value="Djibouti">Djibouti </option>
                                                    <option value="Dominique">Dominique </option>

                                                    <option value="Egypte">Egypte </option>
                                                    <option value="Emirats_Arabes_Unis">Emirats-Arabes-Unis </option>
                                                    <option value="Equateur">Equateur </option>
                                                    <option value="Erythree">Erythree </option>
                                                    <option value="Espagne">Espagne </option>
                                                    <option value="Estonie">Estonie </option>
                                                    <option value="Etats_Unis">Etats_Unis </option>
                                                    <option value="Ethiopie">Ethiopie </option>

                                                    <option value="Falkland">Falkland </option>
                                                    <option value="Feroe">Feroe </option>
                                                    <option value="Fidji">Fidji </option>
                                                    <option value="Finlande">Finlande </option>
                                                    <option value="France">France </option>

                                                    <option value="Gabon">Gabon </option>
                                                    <option value="Gambie">Gambie </option>
                                                    <option value="Georgie">Georgie </option>
                                                    <option value="Ghana">Ghana </option>
                                                    <option value="Gibraltar">Gibraltar </option>
                                                    <option value="Grece">Grece </option>
                                                    <option value="Grenade">Grenade </option>
                                                    <option value="Groenland">Groenland </option>
                                                    <option value="Guadeloupe">Guadeloupe </option>
                                                    <option value="Guam">Guam </option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guernesey">Guernesey </option>
                                                    <option value="Guinee">Guinée </option>
                                                    <option value="Guinee_Bissau">Guinée-Bissau </option>
                                                    <option value="Guinee equatoriale">Guinee-Equatoriale </option>
                                                    <option value="Guyana">Guyana </option>
                                                    <option value="Guyane_Francaise ">Guyane-Francaise </option>

                                                    <option value="Haiti">Haiti </option>
                                                    <option value="Hawai">Hawaï </option>
                                                    <option value="Honduras">Honduras </option>
                                                    <option value="Hong_Kong">Hong-Kong </option>
                                                    <option value="Hongrie">Hongrie </option>

                                                    <option value="Inde">Inde </option>
                                                    <option value="Indonesie">Indonesie </option>
                                                    <option value="Iran">Iran </option>
                                                    <option value="Iraq">Iraq </option>
                                                    <option value="Irlande">Irlande </option>
                                                    <option value="Islande">Islande </option>
                                                    <option value="Israel">Israël </option>
                                                    <option value="Italie">Italie </option>

                                                    <option value="Jamaique">Jamaique </option>
                                                    <option value="Jan Mayen">Jan Mayen </option>
                                                    <option value="Japon">Japon </option>
                                                    <option value="Jersey">Jersey </option>
                                                    <option value="Jordanie">Jordanie </option>

                                                    <option value="Kazakhstan">Kazakhstan </option>
                                                    <option value="Kenya">Kenya </option>
                                                    <option value="Kirghizstan">Kirghizistan </option>
                                                    <option value="Kiribati">Kiribati </option>
                                                    <option value="Koweit">Koweit </option>

                                                    <option value="Laos">Laos </option>
                                                    <option value="Lesotho">Lesotho </option>
                                                    <option value="Lettonie">Lettonie </option>
                                                    <option value="Liban">Liban </option>
                                                    <option value="Liberia">Liberia </option>
                                                    <option value="Liechtenstein">Liechtenstein </option>
                                                    <option value="Lituanie">Lituanie </option>
                                                    <option value="Luxembourg">Luxembourg </option>
                                                    <option value="Lybie">Lybie </option>

                                                    <option value="Macao">Macao </option>
                                                    <option value="Macedoine">Macédoine </option>
                                                    <option value="Madagascar">Madagascar </option>
                                                    <option value="Madère">Madère </option>
                                                    <option value="Malaisie">Malaisie </option>
                                                    <option value="Malawi">Malawi </option>
                                                    <option value="Maldives">Maldives </option>
                                                    <option value="Mali">Mali </option>
                                                    <option value="Malte">Malte </option>
                                                    <option value="Man">Man </option>
                                                    <option value="Mariannes du Nord">Mariannes du Nord </option>
                                                    <option value="Maroc">Maroc </option>
                                                    <option value="Marshall">Marshall </option>
                                                    <option value="Martinique">Martinique </option>
                                                    <option value="Maurice">Maurice </option>
                                                    <option value="Mauritanie">Mauritanie </option>
                                                    <option value="Mayotte">Mayotte </option>
                                                    <option value="Mexique">Mexique </option>
                                                    <option value="Micronesie">Micronésie </option>
                                                    <option value="Midway">Midway </option>
                                                    <option value="Moldavie">Moldavie </option>
                                                    <option value="Monaco">Monaco </option>
                                                    <option value="Mongolie">Mongolie </option>
                                                    <option value="Montserrat">Montserrat </option>
                                                    <option value="Mozambique">Mozambique </option>

                                                    <option value="Namibie">Namibie </option>
                                                    <option value="Nauru">Nauru </option>
                                                    <option value="Nepal">Népal </option>
                                                    <option value="Nicaragua">Nicaragua </option>
                                                    <option value="Niger">Niger </option>
                                                    <option value="Nigeria">Nigéria </option>
                                                    <option value="Niue">Niue </option>
                                                    <option value="Norfolk">Norfolk </option>
                                                    <option value="Norvege">Norvege </option>
                                                    <option value="Nouvelle_Caledonie">Nouvelle-Caledonie </option>
                                                    <option value="Nouvelle_Zelande">Nouvelle-Zélande </option>

                                                    <option value="Oman">Oman </option>
                                                    <option value="Ouganda">Ouganda </option>
                                                    <option value="Ouzbekistan">Ouzbékistan </option>

                                                    <option value="Pakistan">Pakistan </option>
                                                    <option value="Palau">Palau </option>
                                                    <option value="Palestine">Palestine </option>
                                                    <option value="Panama">Panama </option>
                                                    <option value="Papouasie_Nouvelle_Guinee">Papouasie Nouvelle Guinée </option>
                                                    <option value="Paraguay">Paraguay </option>
                                                    <option value="Pays_Bas">Pays-Bas </option>
                                                    <option value="Perou">Pérou </option>
                                                    <option value="Philippines">Philippines </option>
                                                    <option value="Pologne">Pologne </option>
                                                    <option value="Polynesie">Polynesie </option>
                                                    <option value="Porto_Rico">Porto_Rico </option>
                                                    <option value="Portugal">Portugal </option>

                                                    <option value="Qatar">Qatar </option>

                                                    <option value="Republique_Dominicaine">République Dominicaine </option>
                                                    <option value="Republique_Tcheque">République Tchèque </option>
                                                    <option value="Reunion">Réunion </option>
                                                    <option value="Roumanie">Roumanie </option>
                                                    <option value="Royaume_Uni">Royaume-Uni </option>
                                                    <option value="Russie">Russie </option>
                                                    <option value="Rwanda">Rwanda </option>

                                                    <option value="Sahara Occidental">Sahara Occidental </option>
                                                    <option value="Sainte_Lucie">Sainte-Lucie </option>
                                                    <option value="Saint_Marin">Saint-Marin </option>
                                                    <option value="Salomon">Salomon </option>
                                                    <option value="Salvador">Salvador </option>
                                                    <option value="Samoa_Occidentales">Samoa-Occidentales</option>
                                                    <option value="Samoa_Americaine">Samoa-Americaine </option>
                                                    <option value="Sao_Tome_et_Principe">Sao-Tome-et-Principe </option>
                                                    <option value="Senegal">Sénégal </option>
                                                    <option value="Seychelles">Seychelles </option>
                                                    <option value="Sierra Leone">Sierra Leone </option>
                                                    <option value="Singapour">Singapour </option>
                                                    <option value="Slovaquie">Slovaquie </option>
                                                    <option value="Slovenie">Slovenie</option>
                                                    <option value="Somalie">Somalie </option>
                                                    <option value="Soudan">Soudan </option>
                                                    <option value="Sri_Lanka">Sri-Lanka </option>
                                                    <option value="Suede">Suede </option>
                                                    <option value="Suisse">Suisse </option>
                                                    <option value="Surinam">Surinam </option>
                                                    <option value="Swaziland">Swaziland </option>
                                                    <option value="Syrie">Syrie </option>

                                                    <option value="Tadjikistan">Tadjikistan </option>
                                                    <option value="Taiwan">Taiwan </option>
                                                    <option value="Tonga">Tonga </option>
                                                    <option value="Tanzanie">Tanzanie </option>
                                                    <option value="Tchad">Tchad </option>
                                                    <option value="Thailande">Thailande </option>
                                                    <option value="Tibet">Tibet </option>
                                                    <option value="Timor_Oriental">Timor-Oriental </option>
                                                    <option value="Togo">Togo </option>
                                                    <option value="Trinite_et_Tobago">Trinite-et-Tobago </option>
                                                    <option value="Tristan da cunha">Tristan de cuncha </option>
                                                    <option value="Tunisie">Tunisie </option>
                                                    <option value="Turkmenistan">Turmenistan </option>
                                                    <option value="Turquie">Turquie </option>

                                                    <option value="Ukraine">Ukraine </option>
                                                    <option value="Uruguay">Uruguay </option>

                                                    <option value="Vanuatu">Vanuatu </option>
                                                    <option value="Vatican">Vatican </option>
                                                    <option value="Venezuela">Venezuela </option>
                                                    <option value="Vierges_Americaines">Vierges-Americaines </option>
                                                    <option value="Vierges_Britanniques">Vierges-Britanniques </option>
                                                    <option value="Vietnam">Viêtnam </option>

                                                    <option value="Wake">Wake </option>
                                                    <option value="Wallis et Futuma">Wallis et Futuma </option>

                                                    <option value="Yemen">Yémen </option>
                                                    <option value="Yougoslavie">Yougoslavie </option>

                                                    <option value="Zambie">Zambie </option>
                                                    <option value="Zimbabwe">Zimbabwe </option>

                                                    </select>

                                            </div>
                                            <!-- Break -->
                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Demande d'adhésion" class="primary" name="envoi-form"/></li>
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
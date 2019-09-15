<?php
session_start();
if(isset($_POST['envoi-mail']))
{
    if(isset($_POST['name-mail']) AND !empty($_POST['name-mail'])  AND isset($_POST['email-mail']) AND !empty($_POST['email-mail']) AND isset($_POST['message-mail']) AND !empty($_POST['message-mail']))
    {
        $nom = htmlspecialchars($_POST['name-mail']);
        $email = htmlspecialchars($_POST['email-mail']);
        $message = htmlspecialchars($_POST['message-mail']);
        
        $nomlength = strlen($nom);
        $emaillength = strlen($email);
        $messagelength = strlen($message);

        if($nomlength <= 255 AND $emaillength <= 255 AND $messagelength <= 2000)
        {
            $texte = nl2br($message);
            if(isset($_POST['copy-mail']))
            {
                if($_POST['copy-mail'] == "on")
                {
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
                    <body>Bonjour ".$nom.",<br/>
                    Voici ce que vous avez envoyé à l'équipe de DVKBuntu : <br/> \"".$texte." \" <br/>Merci de votre participation,<br/><i>L'équipe DVKBuntu</i></body>
                    </html>";

                    //=====Création de la boundary

                    $boundary = "-----=".md5(rand());

                    //=====Définition du sujet.

                    $sujet = "Copie de votre message à DVKBuntu";

                    //=====Création du header de l'e-mail.

                    $header = "From: \"DVKBuntu\"<noreply.decanniere@gmail.com>".$passage_ligne;
                    $header.= "Reply-to: \"DVKBuntu\" <noreply.decanniere@gmail.com>".$passage_ligne;
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
                    mail($email,$sujet,$message,$header);
                }
            
            }
            
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
            <body>".$texte."</body>
            </html>";

            //=====Création de la boundary

            $boundary = "-----=".md5(rand());

            //=====Définition du sujet.

            $sujet = "Nouveau message de ".$nom;

            //=====Création du header de l'e-mail.

            $header = "From: ".$nom."<".$email.">".$passage_ligne;
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
            $mail="handyopensourcedvkbuntu@gmail.com";
            mail($mail,$sujet,$message,$header);
            
            header("location: contact.php?k=678997");
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
else
{
    header('Location: erreur.php');
}

?>
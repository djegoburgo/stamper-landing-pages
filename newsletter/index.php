<!DOCTYPE html><html><head><title>Stamper | Coming soon</title><meta charset="utf-8"/><meta name="description" content="Stamper, messages and stories in the real world"><meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1; user-scalable=no;"/><meta name="msapplication-tap-highlight" content="no"/> <meta property="og:url" content="http://www.stamperapp.com/"/> <meta property="og:image" content="http://www.stamperapp.com/images/og.gif"/> <meta property="og:image:width" content="100"/> <meta property="og:image:height" content="100"/> <meta property="og:description" content="Allez viens, on est bien !"/> <link class="fav" rel="icon" type="image/png" href="images/desktop/favicon.png"/><link rel="stylesheet" type="text/css" href="css/style.min.css"> <script type="text/javascript">(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-56083269-1', 'auto'); ga('send', 'pageview'); </script> <script type="text/javascript">var isSafari=/Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor); if (isSafari){var html=document.querySelector('html'); html.setAttribute("class", "safari");}</script></head><body><main><div class="bg photo1"><div class="filterGray"></div></div><div class="bg photo2"><div class="filterGray"></div></div><div class="bg photo3"><div class="filterGray"></div></div><div class="bg photo4"><div class="filterGray"></div></div><div class="logo"></div><div class="bannerBox"><div class="banner"><p>The digital guestbook for your place</p><div class="register"><form id="formulaire" method="post"> <input class="champMail" type="email" id="email" name="email" placeholder="Enter email to join the beta" value="<?php echo (isset($_POST['email'])) ? $expediteur : '' ?>"> <input type="submit" name="send" value="Come in !"></form> </div><div class="stores"> <ul> <li id="ios"></li><li class="android"></li></ul> </div></div></div><?php
    /* Si le formulaire est envoyé alors on fait les traitements */
    if (isset($_POST['send']))
    {
        /* Récupération des valeurs des champs du formulaire */
        if (get_magic_quotes_gpc())
        {
          $expediteur   = stripslashes(trim($_POST['email']));
        }
        else
        {
          $expediteur   = trim($_POST['email']);
        }
     
        /* Expression régulière permettant de vérifier si le 
        * format d'une adresse e-mail est correct */
        $regex_mail = '/^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$/i';
     
        /* Expression régulière permettant de vérifier qu'aucun 
        * en-tête n'est inséré dans nos champs */
        $regex_head = '/[\n\r]/';
     
        /* Si le formulaire n'est pas posté de notre site on renvoie 
        * vers la page d'accueil */
        if($_SERVER['HTTP_REFERER'] != 'http://www.stamperapp.com/')
        {
          header('Location: http://www.stamperapp.com/');
        }
        /* On vérifie que tous les champs sont remplis */
        elseif (empty($expediteur)){
          $alert = 'Tous les champs doivent être renseignés';
        }
        /* On vérifie que le format de l'e-mail est correct */
        elseif (!preg_match($regex_mail, $expediteur))
        {
          $alert = 'L\'adresse '.$expediteur.' n\'est pas valide';
        }
        /* On vérifie qu'il n'y a aucun header dans les champs */
        elseif (preg_match($regex_head, $expediteur))
        {
            $alert = 'En-têtes interdites dans les champs du formulaire';
        }
        /* Si aucun problème et aucun cookie créé, on construit le message et on envoie l'e-mail */
        elseif (!isset($_COOKIE['sent']))
        {
            /* Destinataire (votre adresse e-mail) */
            $to = 'stamperapp@gmail.com';
     
            /* Construction du message */
            $msg  = 'Bonjour,'."\r\n\r\n";
            $msg .= 'Je souhaite tester la version beta de Stamper.'."\r\n\r\n";
            $msg .= 'Voici mon adresse mail :'."\r\n";
            $msg .= $expediteur."\r\n";
     
            /* En-têtes de l'e-mail */
            $headers = 'From: <'.$expediteur.'>'."\r\n\r\n";
     
            /* Envoi de l'e-mail */
            if (mail($to, 'Stamper beta test', $msg, $headers))
            {
                /* On créé un cookie de courte durée (ici 10 secondes) pour éviter de 
                * renvoyer un mail en rafraichissant la page */
                setcookie("sent", "1", time() + 10);
                /*On redirige vers la referral page*/
                header('Location: http://rfsp.co/l/8wVsw8c5/');
                /* On détruit la variable $_POST */
                unset($_POST);
            }else{
                echo '<p class="confirm">Error !</p>';
            }
     
        }
        /* Cas où le cookie est créé et que la page est rafraichie, on détruit la variable $_POST */
        else
        {
            unset($_POST);
        }
    }
?>
<div class="socialMedias"><ul><li><a href="https://www.facebook.com/getstamperapp"></a></li><li><a href="https://twitter.com/stamperapp"></a></li><li><a href="http://instagram.com/stamperapp"></a></li><li><a href="https://medium.com/@jeromeburgaud/never-forget-why-you-call-a-place-home-1dbd5a6da77"></a></li></ul></div></main></body><script type="text/javascript" src="js/jquery.js"></script> <script type="text/javascript" src="js/app.min.js"></script> <script>(function(){var email=document.getElementById('email'); email.addEventListener('keypress', function(event){if (event.keyCode==13){document.getElementById("formulaire").submit();}});}()); </script></html>
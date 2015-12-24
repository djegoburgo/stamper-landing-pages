<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the form fields and remove whitespace.
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        // Check that data was sent to the mailer.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! Un problème est survenu lors de l'envoi de l'e-mail. Merci de réessayer ultérieurement.";
            exit;
        }

        $to      = 'stamperapp@gmail.com';
        $subject = 'New beta testeur';
        $message = $email."\r\n";
        $headers = 'From: <'.$email.'>'."\r\n\r\n";

        mail($to, $subject, $message, $headers);

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Un problème est survenu lors de l'envoi de l'e-mail. Merci de réessayer ultérieurement.";
    }


?>
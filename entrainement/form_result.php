<?php
    session_start();

    $_SESSION['nom'] = $_POST["user_name"];
    $_SESSION['mail'] = $_POST["user_mail"];
    $_SESSION['message'] = $_POST["user_message"];

    setcookie( 'nom', $_POST["user_name"], time() + 60 * 60 * 24 );
    setcookie( 'mail', $_POST["user_mail"], time() + 60 * 60 * 24 );
    setcookie( 'message', $_POST["user_message"], time() + 60 * 60 * 24 );

    echo "<a href='/search_artist.php'>Accueil</a>";

    echo "<br><br>";

    echo "Nom : " . $_POST["user_name"];
    echo "<br>";
    echo "Mail : " . $_POST["user_mail"];
    echo "<br>";
    echo "Message : " . $_POST["user_message"];

    echo "<br><br>";

    var_dump($_SESSION);


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Titre</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/template.css">
</head>

<body>
<header>
    <nav class="navbar navbar-dark bg-dark box-shadow">
        <div class="container py-3">
            <a href="/" class="nav col-12 col-lg-auto my-2
                    justify-content-center my-md-0 h2 text-secondary" id="application">Spotify API</a>
            <ul class="nav col-12 col-lg-auto my-2
                            justify-content-center my-md-0 h6">
                <li>
                    <a href="/" class="nav-link
                                    text-primary">
                        <i class="icon icon_house"></i>
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="/test" class="nav-link text-white">
                        <i class="icon icon_info-circle"></i>
                        Test
                    </a>
                </li>
                <li>
                    <div id="nav-btn">
                        <a href="/searchArtist/list" class="btn btn-outline-secondary">Search artist</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="bg-light min-vh-100">
    <div class="text-center py-4">
        <div class="container">
            <h1>Accueil</h1>
            <p class="lead text-primary">Bienvenue sur Spotify API !</p>
        </div>
    </div>

    <div class="container pb-5">
        <!--        --><?php //if(!empty($_SESSION['erreur'])): ?>
        <!--            <div class="alert alert-danger" role="alert">-->
        <!--                --><?php //echo $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
        <!--            </div>-->
        <!--        --><?php //endif; ?>
        <!--        --><?php //if(!empty($_SESSION['message'])): ?>
        <!--            <div class="alert alert-success" role="alert">-->
        <!--                --><?php //echo $_SESSION['message']; unset($_SESSION['message']); ?>
        <!--            </div>-->
        <!--        --><?php //endif; ?>
        <?php
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=orelsan&type=artist");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            echo $result;
            curl_close($ch);
        ?>
    </div>
</main>

<footer class="py-3 py-4 bg-dark">
    <div class="container">
        <nav>
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link
                                px-2 text-white"><i class="icon icon_facebook"></i> Facebook</a></li>
                <li class="nav-item"><a href="#" class="nav-link
                                px-2 text-white"><i class="icon icon_instagram"></i> Instagram</a></li>
                <li class="nav-item"><a href="#" class="nav-link
                                px-2 text-white"><i class="icon icon_linkedin"></i> LinkedIn</a></li>
            </ul>
        </nav>
        <p class="text-center text-white">&copy; Copyright 2022 - CARRA
            Justin</p>
    </div>
</footer>

<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>

</html>
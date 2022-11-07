<?php
    use App\Autoloader;
    use App\Entity\Artist;

    require 'Auth-Spotify.php';
    require_once 'Autoloader.php';
    Autoloader::register();
?>

<!DOCTYPE html>
<html lang="fr">
    <?php
        $titre_page = "Liste des artistes";
        include "inc_head.php";
    ?>

    <body>
        <?php include "inc_header.php" ?>

        <main class="bg-light min-vh-100">
            <div class="text-center py-4">
                <div class="container">
                    <h1>Liste des artistes</h1>
                    <p class="lead text-primary">Voici tous les artistes trouvés avec la recherche !</p>
                </div>
            </div>

            <div class="container pb-5">
                <div class="row d-flex justify-content-center">
                    <form action="/search_artist.php" class="col-md-6 d-flex justify-content-between mt-2 mt-md-0" method="post">
                        <input class="form-control mr-sm-2" type="text" name="name" placeholder="Artiste">
                        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Rechercher</button>
                    </form>
                </div>
            </div>

            <div class="container pb-5">
                <div class="row">
                    <?php

                    if(isset($_POST["name"]))
                    {
                        $name = $_POST["name"];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=$name&type=artist");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $result = json_decode(curl_exec($ch));
                        curl_close($ch);
                        foreach($result->artists->items as $item)
                        {
                            if(isset($item->images[0]) && !empty($item->images[0]))
                            {
                                $image = $item->images[0]->url;
                            }
                            else
                            {
                                $image = "";
                            }
                            $artist = new Artist($item->id, $item->name, $item->followers->total, $item->genres, $item->href, $image);
                            echo $artist->display();
                        }
                    }
                    ?>
                </div>
            </div>
        </main>

        <?php include "inc_footer.php" ?>
    </body>
</html>
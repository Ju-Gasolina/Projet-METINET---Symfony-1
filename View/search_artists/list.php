<div class="text-center py-4">
    <div class="container">
        <h1>Liste des artistes</h1>
        <p class="lead text-primary">Voici tous les artistes trouvés pour la recherche "<?= $q ?>" !</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row d-flex justify-content-center">
        <form action="/searchArtist/list" class="col-md-6 d-flex justify-content-between mt-2 mt-md-0" method="post">
            <input class="form-control mr-sm-2" type="text" name="name" placeholder="Artiste">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <?php
            if(isset($artists))
            {
                foreach ($artists as $artist)
                {
                    echo $artist->display();
                }
            }
        ?>
    </div>
</div>
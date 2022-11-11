<div class="text-center py-4">
    <div class="container">
        <h1>Liste des albums favoris</h1>
        <p class="lead text-primary">Voici tous vos albums favoris !</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <?php
            if(isset($albums))
            {
                foreach ($albums as $album)
                {
                    echo $album->displayFavorite();
                }
            }
        ?>
    </div>
</div>
<div class="text-center py-4">
    <div class="container">
        <h1>Liste des albums</h1>
        <p class="lead text-primary">Voici tous les albums trouvés pour l'artiste "<?= $artist ?>" !</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <?php
            if(isset($albums))
            {
                foreach ($albums as $album)
                {
                    echo $album->display();
                }
            }
        ?>
    </div>
</div>
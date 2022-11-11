<div class="text-center py-4">
    <div class="container">
        <h1>Liste des musiques favorites</h1>
        <p class="lead text-primary">Voici toutes vos musiques favorites !</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <?php
            if(isset($tracks))
            {
                foreach ($tracks as $track)
                {
                    echo $track->display();
                }
            }
        ?>
    </div>
</div>
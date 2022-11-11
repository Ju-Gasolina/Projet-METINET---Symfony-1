<div class="text-center py-4">
    <div class="container">
        <h1>Liste des artistes favoris</h1>
        <p class="lead text-primary">Voici tous vos artistes favoris !</p>
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
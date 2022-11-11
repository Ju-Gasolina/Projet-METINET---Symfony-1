<?php

namespace App\Entity;

class Track extends Model
{
    public int $id;

    public function __construct(
        public string $idSpotify,

        public string $name,

        public int    $trackNumber,

        public int    $duration,

        public string $link,

        public string $albumName,

        public string $albumPicture,
    )
    {
        $this->table = "tracks";
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getIdSpotify(): string
    {
        return $this->idSpotify;
    }

    public function setIdSpotify(string $idSpotify): self
    {
        $this->idSpotify = $idSpotify;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getTrackNumber(): int
    {
        return $this->trackNumber;
    }

    public function setTrackNumber(int $trackNumber): self
    {
        $this->trackNumber = $trackNumber;
        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getAlbumName(): string
    {
        return $this->albumName;
    }

    public function setAlbumName(string $albumName): self
    {
        $this->albumName = $albumName;
        return $this;
    }

    public function getAlbumPicture(): string
    {
        return $this->albumPicture;
    }

    public function setAlbumPicture(string $albumPicture): self
    {
        $this->albumPicture = $albumPicture;
        return $this;
    }

    public function display(): string
    {
        $trackSearch = new Track('', '', 0, 0, '', '', '');
        $resultSearch = $trackSearch->findBy(array('idSpotify' => $this->getIdSpotify()));

        if(empty($resultSearch))
        {
            $favoriteAction =
                "<form action='/track/addFavorite/" . $this->getIdSpotify() . "' method='post' class='card-title px-1' target='_blank'>
                        <input type='hidden' name='idSpotify' value='" . $this->getIdSpotify() . "'>
                        <input type='hidden' name='name' value='" . $this->getName() . "'>
                        <input type='hidden' name='trackNumber' value='" . $this->getTrackNumber() . "'>
                        <input type='hidden' name='duration' value='" . $this->getDuration() . "'>
                        <input type='hidden' name='link' value='" . $this->getLink() . "'>
                        <input type='hidden' name='albumName' value='" . $this->getAlbumName() . "'>
                        <input type='hidden' name='albumPicture' value='" . $this->getAlbumPicture() . "'>
                        
                        <button class='icon icon_star' type='submit' title='Cliquer pour ajouter cette musique à vos favoris'></button>
                </form>";
        }
        else
        {
            $favoriteAction =
                "<form action='/track/deleteFavorite/".$this->getId()."' method='post' class='card-title px-1' target='_blank'>        
                    <button class='icon icon_star-fill text-warning' type='submit' title='Cliquer pour supprimer cette musique de vos favoris'></button>
                </form>";
        }

        return
            "
        <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <img class='card-img-top' src=" . $this->getAlbumPicture() . " alt='Photo de l\'album " . $this->getAlbumName() . "'>
                <div class='card-body'>
                    <div class='d-flex align-items-center justify-content-center'>
                        <p class='card-title h5 text-center'>" . $this->getName() . "</p>"
                    . $favoriteAction .
                    "</div>
                    
                    <p class='card-text'>Numéro de la musique : " . $this->getTrackNumber() . "</p>
                    <p class='card-text'>Durée de la musique (en ms) : " . $this->getDuration() . "</p>
                    <div class='text-center'>
                        <a href=" . $this->getLink() . " class='btn btn-secondary text-white' title='Cliquer pour voir la page Spotify de cette musique' target='_blank'>Page Spotify de la musique</a>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
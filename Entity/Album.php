<?php

namespace App\Entity;

class Album extends Model
{
    public int $id;
    public function __construct(
        public string $idSpotify,

        public string $name,

        public string $releaseDate,

        public int  $totalTracks,

        public string $link,

        public string $picture,
    )
    {
        $this->table = "albums";
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

    public function setReleaseDate(string $releaseDate): self
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getTotalTracks(): int
    {
        return $this->totalTracks;
    }

    public function setTotalTracks(int $totalTracks): self
    {
        $this->totalTracks = $totalTracks;
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


    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function display(): string
    {
        $albumSearch = new Album('', '', 0, 0, '', '');
        $resultSearch = $albumSearch->findBy(array('idSpotify' => $this->getIdSpotify()));

        if(empty($resultSearch))
        {
            $favoriteAction =
                "<form action='/album/addFavorite/".$this->getIdSpotify()."' method='post' class='card-title px-1' target='_blank'>
                    <input type='hidden' name='idSpotify' value='".$this->getIdSpotify()."'>
                    <input type='hidden' name='name' value='".$this->getName()."'>
                    <input type='hidden' name='releaseDate' value='".$this->getReleaseDate()."'>
                    <input type='hidden' name='totalTracks' value='".$this->getTotalTracks()."'>
                    <input type='hidden' name='link' value='".$this->getLink()."'>
                    <input type='hidden' name='picture' value='".$this->getPicture()."'>
                    
                    <button class='icon icon_star' type='submit' title='Cliquer pour ajouter cet album à vos favoris'></button>
                </form>";
        }
        else
        {
            $favoriteAction =
                "<form action='/album/deleteFavorite/".$this->getId()."' method='post' class='card-title px-1' target='_blank'>        
                    <button class='icon icon_star-fill text-warning' type='submit' title='Cliquer pour supprimer cet album de vos favoris'></button>
                </form>";
        }


        return
            "
        <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <img class='card-img-top' src=".$this->getPicture()." alt='Photo de ".$this->getName()."'>
                <div class='card-body'>
                    <div class='d-flex align-items-center justify-content-center'>
                        <p class='card-title h5 text-center'>".$this->getName()."</p>"
                    . $favoriteAction .
                    "</div>
                        
                    <p class='card-text'>Date de sortie : ".$this->getReleaseDate()."</p>
                    <p class='card-text'>Nombre de musiques : ".$this->getTotalTracks()."</p>
                    <div class='text-center'>
                        <a href=".$this->getLink()." class='btn btn-secondary text-white' title='Cliquer pour voir la page Spotify de cet albums' target='_blank'>Page Spotify de l'album</a>
                         <form action='/track/list/".$this->getIdSpotify()."' method='post' target='_blank'>
                            <input type='hidden' name='albumName' value='".$this->getName()."'>
                            <input type='hidden' name='albumPicture' value='".$this->getPicture()."'>
                            <button class='btn btn-secondary text-white' type='submit' title='Cliquer pour voir les musiques de cet album'>Musiques de cet album</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
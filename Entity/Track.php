<?php

namespace App\Entity;

class Track
{

    public function __construct(
        public string $id,

        public string $name,

        public int $trackNumber,

        public int $duration,

        public string $link,

        public string $albumName,

        public string $albumPicture,
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
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
        return
            "
        <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <img class='card-img-top' src=".$this->getAlbumPicture()." alt='Photo de l\'album ".$this->getAlbumName()."'>
                <div class='card-body'>
                    <p class='card-title h5 text-center'>".$this->getName()."</p>
                    <p class='card-text'>Numéro de la musique : ".$this->getTrackNumber()."</p>
                    <p class='card-text'>Durée de la musique (en ms) : ".$this->getDuration()."</p>
                    <div class='text-center'>
                        <a href=".$this->getLink()." class='btn btn-secondary text-white' title='Cliquer pour voir la page Spotify de cette musique' target='_blank'>Page Spotify de la musique</a>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
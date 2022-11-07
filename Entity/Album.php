<?php

namespace App\Entity;

class Album
{

    public function __construct(
        public string $id,

        public string $name,

        public string $releaseDate,

        public int  $totalTracks,

        public string $link,

        public string $picture,
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
        return
            "
        <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <img class='card-img-top' src=".$this->getPicture()." alt='Photo de ".$this->getName()."'>
                <div class='card-body'>
                    <p class='card-title h5 text-center'>".$this->getName()."</p>
                    <p class='card-text'>Date de sortie : ".$this->getReleaseDate()."</p>
                    <p class='card-text'>Nombre de musiques : ".$this->getTotalTracks()."</p>
                    <a href=".$this->getLink()." class='btn btn-secondary stretched-link text-white' title='Cliquer pour voir la page Spotify de cet album' target='_blank'>Page Spotify de l'album</a>
                </div>
            </div>
        </div>
        ";
    }
}
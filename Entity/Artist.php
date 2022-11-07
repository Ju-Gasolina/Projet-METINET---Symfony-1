<?php

namespace App\Entity;

class Artist extends Model
{
    public int $id;
    public function __construct(
        public string $idSpotify,

        public string $name,

        public int $followers,

        public array  $genders,

        public string $link,

        public string $picture,
    )
    {
        $this->table = "artists";
    }

    public function getId(): string
    {
        return $this->idSpotify;
    }

    public function setId(string $idSpotify): self
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

    public function setFollowers(int $followers): self
    {
        $this->followers = $followers;
        return $this;
    }

    public function getFollowers(): int
    {
        return $this->followers;
    }

    public function getGenders(): array
    {
        return $this->genders;
    }

    public function setGenders(array $genders): self
    {
        $this->genders = $genders;
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
        $gendersText = "";
        foreach($this->genders as $gender)
        {
            $gendersText .= "- " . $gender . "<br>";
        }

        $linkText = str_replace("https://api.spotify.com/v1/artists/", "https://open.spotify.com/artist/", $this->getLink());

        return
            "
        <div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <img class='card-img-top' src=".$this->getPicture()." alt='Photo de ".$this->getName()."'>
                <div class='card-body'>
                    <p class='card-title h5 text-center'>".$this->getName()."</p>
                    <p class='card-text'>".$gendersText."</p>
                    <div class='text-center'>
                        <a href=".$linkText." class='btn btn-secondary text-white' title='Cliquer pour voir la page Spotify de cet artiste' target='_blank'>Page Spotify de l'artiste</a>
                        <a href='/album/list/".$this->getId()."' class='btn btn-secondary text-white' title='Cliquer pour voir les albums de cet artiste' target='_blank'>Albums de l'artiste</a>
                        <form action='/SearchArtist/addFavorite/".$this->getId()."' method='post'>
                            <input type='hidden' name='idSpotify' value='".$this->getId()."'>
                            <input type='hidden' name='name' value='".$this->getName()."'>
                            <input type='hidden' name='followers' value='".$this->getFollowers()."'>
                            <input type='hidden' name='genders' value='". json_encode($this->getGenders()) ."'>
                            <input type='hidden' name='link' value='".$this->getLink()."'>
                            <input type='hidden' name='pictures' value='".$this->getPicture()."'>
                            
                            <button class='btn btn-primary text-white' type='submit' title='Cliquer pour cet artiste à vos favoris'>Ajouter à vos favoris</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
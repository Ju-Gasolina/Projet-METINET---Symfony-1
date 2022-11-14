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

        $artistSearch = new Artist('', '', 0, array(), '', '');
        $resultSearch = $artistSearch->findBy(array('idSpotify' => $this->getIdSpotify()));

        if(empty($resultSearch))
        {
            $favoriteAction =
                '<form action="/SearchArtist/addFavorite" method="post" class="px-1">
                    <input type="hidden" name="idSpotify" value="'.$this->getIdSpotify().'">
                    <input type="hidden" name="name" value="'.$this->getName().'">
                    <input type="hidden" name="followers" value="'.$this->getFollowers().'">
                    <input type="hidden" name="genders" '."value='". json_encode($this->getGenders()) ."'".'>
                    <input type="hidden" name="link" value="'.$this->getLink().'">
                    <input type="hidden" name="picture" value="'.$this->getPicture().'">
                    
                    <button class="icon icon_star" type="submit" title="Cliquer pour ajouter cet artiste à vos favoris"></button>
                </form>';
        }
        else
        {
            $favoriteAction =
                "<form action='/SearchArtist/deleteFavorite/".$this->getId()."' method='post' class='card-title px-1'>        
                    <button class='icon icon_star-fill text-warning' type='submit' title='Cliquer pour supprimer cet album de vos favoris'></button>
                </form>";
        }

        return
            "<div class='col-lg-3 col-md-4 col-sm-6 mb-4'>
                <div class='card'>
                    <img class='card-img-top' src=".$this->getPicture()." alt='Photo de ".$this->getName()."'>
                    <div class='card-body'>
                        <div class='d-flex align-items-center justify-content-center'>
                            <p class='card-title h5 text-center px-1'>".$this->getName()."</p>"
                . $favoriteAction .
                "</div>
                        
                        <p class='card-text'>".$gendersText."</p>
                        <div class='text-center'>
                            <a href=".$linkText." class='btn btn-secondary text-white' title='Cliquer pour voir la page Spotify de cet artiste' target='_blank'>Page Spotify de l'artiste</a>
                            <a href='/album/list/".$this->getIdSpotify()."' class='btn btn-secondary text-white' title='Cliquer pour voir les albums de cet artiste' target='_blank'>Albums de l'artiste</a>
                        </div>
                    </div>
                </div>
            </div>";
    }
}
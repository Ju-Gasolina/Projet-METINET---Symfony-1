<?php

namespace App\Entity;

class Artist
{
    public function __construct
    (
        public string $id,
        public string $name,
        public int $followers,
        public array $genders,
        public string $link,
        public string|null $picture
    )
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getFollowers(): int
    {
        return $this->followers;
    }

    /**
     * @param int $followers
     */
    public function setFollowers(int $followers): self
    {
        $this->followers = $followers;
        return $this;
    }

    /**
     * @return array
     */
    public function getGenders(): array
    {
        return $this->genders;
    }

    /**
     * @param array $genders
     */
    public function setGenders(array $genders): self
    {
        $this->genders = $genders;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
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
                    <a href=".$linkText." class='btn btn-secondary stretched-link text-white' title='Cliquer pour voir les informations de cet artiste'>Informations artiste</a>
                </div>
            </div>
        </div>
        ";
    }
}

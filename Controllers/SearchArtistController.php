<?php

namespace App\Controllers;
use App\Entity\Artist;
use App\Entity\Model;

class SearchArtistController extends Controller
{
    public function index()
    {
        $this->render('main/index', [], 'home');
    }

    public function list()
    {
        if (isset($_POST["name"]) && !empty($_POST["name"])) {
            $name = $_POST["name"];
            $q = $name;

            $name = str_replace(" ", "%20", $name);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=$name&type=artist");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);

            $artists = array();

            foreach ($result->artists->items as $item) {
                if (isset($item->images[0]) && !empty($item->images[0])) {
                    $image = $item->images[0]->url;
                } else {
                    $image = '/pictures/no_file.png';
                }

                $artistSearch = new Artist('', '', 0, array(), '', '');
                $resultSearch = $artistSearch->findBy(array('idSpotify' => $item->id));

                $artist = new Artist($item->id, $item->name, $item->followers->total, $item->genres, $item->href, $image);
                if(!empty($resultSearch))
                {
                    $artist->setId($resultSearch[0]->id);
                }
                array_push($artists, $artist);
            }

            $this->render('search_artists/list', compact('q', 'artists'));
        } else {
            $q = "";
            $this->render('search_artists/list', compact('q'));
        }
    }

    public function addFavorite()
    {
        $artist = new Artist($_POST['idSpotify'], $_POST['name'], $_POST['followers'], json_decode($_POST['genders']), $_POST['link'], $_POST['picture']);

        $artist->create();

        header("Location:/searchArtist/list".$_POST['q']);
    }

    public function deleteFavorite($id)
    {
        $artist = new Artist('', '', 0, array(), '', '');

        $artist->delete($id);

        header("Location:/searchArtist/findFavorite");
    }

    public function findFavorite()
    {
        $artist = new Artist('', '', 0, array(), '', '');

        $items = $artist->findAll();

        $artists = array();

        foreach ($items as $item)
        {
            $artist = new Artist($item->idSpotify, $item->name, $item->followers, json_decode($item->genders), $item->link, $item->picture);
            $artist->setId($item->id);
            array_push($artists, $artist);
        }

        $this->render('search_artists/favorite', compact('artists'));
    }
}
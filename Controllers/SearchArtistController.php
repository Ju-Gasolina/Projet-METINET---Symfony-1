<?php

namespace App\Controllers;
use App\Entity\Artist;

class SearchArtistController extends Controller
{
    public function index()
    {
        $this->render('main/index');
    }

    public function list()
    {
        if(isset($_POST["name"]) && !empty($_POST["name"]))
        {
            $name = $_POST["name"];
            $q= $name;

            $name = str_replace(" ", "%20", $name);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=$name&type=artist");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);

            $artists = array();

            foreach($result->artists->items as $item)
            {
                if(isset($item->images[0]) && !empty($item->images[0]))
                {
                    $image = $item->images[0]->url;
                }
                else
                {
                    $image = '/pictures/no_file.png';
                }
                array_push($artists, new Artist($item->id, $item->name, $item->followers->total, $item->genres, $item->href, $image));
            }

            $this->render('search_artists/list', compact('q', 'artists'));
        }
        else
        {
            $q = "";
            $this->render('search_artists/list', compact('q'));
        }
    }

    public function addFavorite($idSpotify)
    {
        $genders = json_decode($_POST['genders']);

        $artist = new Artist($_POST['idSpotify'],$_POST['name'],$_POST['followers'],$genders,$_POST['link'],$_POST['pictures']);

        $artist->create();

        header("Location:/searchArtist/list");
    }
}
<?php

namespace App\Controllers;
use App\Entity\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $this->render('main/index', [], 'home');
    }

    public function list($idArtist)
    {
        if(isset($idArtist) && !empty($idArtist))
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$idArtist."/albums?limit=50");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);

            $artistIdSpotify = $result->items[0]->artists[0]->id;
            $artist = $result->items[0]->artists[0]->name;

            $albums = array();

            foreach($result->items as $item)
            {
                if(isset($item->images[0]) && !empty($item->images[0]))
                {
                    $image = $item->images[0]->url;
                }
                else
                {
                    $image = '/pictures/no_file.png';
                }

                $albumSearch = new Album('', '', '', 0, '', '', '');
                $resultSearch = $albumSearch->findBy(array('idSpotify' => $item->id));

                $album = new Album($item->id, $item->name, $item->release_date, $item->total_tracks, $item->external_urls->spotify, $image, $artistIdSpotify);
                if(!empty($resultSearch))
                {
                    $album->setId($resultSearch[0]->id);
                }
                array_push($albums, $album);
            }

            $this->render('albums/list', compact('albums', 'artist'));
        }
        else
        {
            $artist = "";
            $this->render('albums/list', compact('artist'));
        }
    }

    public function addFavorite()
    {
        $album = new Album($_POST['idSpotify'], $_POST['name'], $_POST['releaseDate'], $_POST['totalTracks'], $_POST['link'], $_POST['picture'], $_POST['artistIdSpotify']);

        $album->create();

        header('Location:/album/list/'.$_POST['artistIdSpotify']);
    }

    public function deleteFavorite($id)
    {
        $album = new Album('', '', '', 0, '', '', '');

        $artistIdSpotify = $album->findBy(array('id' => $id))[0]->artistIdSpotify;

        $album->delete($id);

        header('Location:/album/list/'.$artistIdSpotify);
    }

    public function findFavorite()
    {
        $album = new Album('', '', '', 0, '', '', '');

        $items = $album->findAll();

        $albums = array();

        foreach ($items as $item)
        {
            $album = new Album($item->idSpotify, $item->name, $item->releaseDate, $item->totalTracks, $item->link, $item->picture, $item->artistIdSpotify);
            $album->setId($item->id);
            array_push($albums, $album);
        }

        $this->render('albums/favorite', compact('albums'));
    }
}
<?php

namespace App\Controllers;
use App\Entity\Album;
use App\Entity\Track;

class TrackController extends Controller
{
    public function index()
    {
        $this->render('main/index', [], 'home');
    }

    public function list($idTrack)
    {
        if(isset($idTrack) && !empty($idTrack))
        {
            // Album
            if(isset($_POST['albumName']) && isset($_POST['albumPicture']))
            {
                $albumName = $_POST['albumName'];
                $albumPicture = $_POST['albumPicture'];
            }
            else
            {
                $albumName = "";
                $albumPicture = "";
            }

            // Track
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/".$idTrack."/tracks?limit=50");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);

            $artist = $result->items[0]->artists[0]->name;

            $tracks = array();

            foreach($result->items as $item)
            {
                $trackSearch = new Track('', '', 0, 0, '', '', '');
                $resultSearch = $trackSearch->findBy(array('idSpotify' => $item->id));

                $track = new Track($item->id, $item->name, $item->track_number, $item->duration_ms, $item->external_urls->spotify, $albumName, $albumPicture);
                if(!empty($resultSearch))
                {
                    $track->setId($resultSearch[0]->id);
                }
                array_push($tracks, $track);
            }

            $this->render('tracks/list', compact('tracks', 'albumName', 'artist'));
        }
        else
        {
            $albumName = "";
            $artist = "";
            $this->render('tracks/list', compact( 'albumName', 'artist'));
        }
    }

    public function addFavorite()
    {
        $track = new Track($_POST['idSpotify'], $_POST['name'], $_POST['trackNumber'], $_POST['duration'], $_POST['link'], $_POST['albumName'], $_POST['albumPicture']);

        $track->create();

        header("Location:/track/findFavorite");
    }

    public function deleteFavorite($id)
    {
        $track = new Track('', '', 0, 0, '', '', '');

        $track->delete($id);

        header("Location:/track/findFavorite");
    }

    public function findFavorite()
    {
        $track = new Track('', '', 0, 0, '', '', '');

        $items = $track->findAll();

        $tracks = array();

        foreach ($items as $item)
        {
            $track = new Track($item->idSpotify, $item->name, $item->trackNumber, $item->duration, $item->link, $item->albumName, $item->albumPicture);
            $track->setId($item->id);
            array_push($tracks, $track);
        }

        $this->render('tracks/favorite', compact('tracks'));
    }
}
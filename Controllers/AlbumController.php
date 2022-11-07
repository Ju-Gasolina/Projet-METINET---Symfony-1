<?php

namespace App\Controllers;
use App\Entity\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $this->render('test/test');
    }

    public function list()
    {
        $params = substr($_SERVER['REQUEST_URI'], 1);
        $params = explode('/', $params);

        if(isset($params[2]) && !empty($params[2]))
        {
            $params = substr($_SERVER['REQUEST_URI'], 1);
            $params = explode('/', $params);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/".$params[2]."/albums");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);

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
                array_push($albums, new Album($item->id, $item->name, $item->release_date, $item->total_tracks, $item->external_urls->spotify, $image));
            }

            $this->render('album/list', compact('albums', 'artist'));
        }
        else
        {
            $this->render('album/list');
        }
    }
}
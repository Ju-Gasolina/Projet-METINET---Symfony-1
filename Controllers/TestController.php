<?php
namespace App\Controllers;


class TestController extends Controller
{
    public function index()
    {
        $this->render('main/index', [], 'home');
    }

    public function test()
    {
        $this->render('test/test');
    }
}
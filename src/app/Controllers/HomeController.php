<?php

namespace App\Controllers;

use App\Core\Http\HttpStatus;
use App\Core\Http\Response;
use App\Core\Mvc\Controller;

class HomeController extends Controller
{
    public function index() 
    {
        $data = array(
            'title' => 'Home',
            'message' => 'Bem-vindo!!'
        );

        return new Response(HttpStatus::OK, $this->loadView('home/home', $data));
    }
}
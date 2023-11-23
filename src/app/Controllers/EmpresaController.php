<?php

namespace App\Controllers;

use App\Core\Http\HttpStatus;
use App\Core\Http\Response;
use App\Core\Mvc\Controller;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    public function list()
    {
        $empresas = Empresa::fetchAll();
        $data = array(
            'title' => 'Empresa',
            'empresas' => $empresas
        );

        return new Response(HttpStatus::OK, $this->loadView('empresa/list', $data));
    }

    public function register() {
        return new Response(HttpStatus::OK, $this->loadView('empresa/register'));
    }
}
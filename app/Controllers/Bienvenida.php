<?php

namespace App\Controllers;

class Bienvenida extends BaseController
{
    public function index()
    {
        return view('pagina_bienvenida');
    }
}

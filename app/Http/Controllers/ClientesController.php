<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function panelCliente()
    {
    	return \View::make('clientes.panel-cliente');
    }
}

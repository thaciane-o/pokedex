<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        // Lógica para listar funcionario
        // Pode incluir paginação, filtros, etc.
        return view('chat.index');
    }

    public function create()
    {
        // Lógica para exibir o formulário de criação de Funcionario
        return view('funcionario.create');
    }

}

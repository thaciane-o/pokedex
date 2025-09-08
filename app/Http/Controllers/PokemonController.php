<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        return view('pokemon.index');
    }

    public function create()
    {
        return view('pokemon.create');
    }

    public function edit($id){
        return view('pokemon.edit');
    }

    public function store(){

    }

    public function update(){

    }
    public function dados(){
        
    }
}

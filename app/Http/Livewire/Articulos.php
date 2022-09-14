<?php

namespace App\Http\Livewire;
use App\Models\Articulo;
use Livewire\Component;

class Articulos extends Component
{
    public $articulos;

    public function render()
    {
        $this->articulos = Articulo::all();
        return view('livewire.articulos')->extends('adminlte::page');
    }
}

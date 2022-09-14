<?php

namespace App\Http\Livewire;
use App\Models\Articulo;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;


class Articulos extends Component
{
    public $articulos, $id_articulo, $Nombre_articulo, $Descripcion_articulo, $Cantidad_articulo;
    public $modal = false;

    public function render(){
        $this->articulos = Articulo::all();
        //return view('livewire.articulos')->extends('adminlte::page');
        return view('livewire.articulos')->extends('adminlte::page');
    }
    
    //añadir articulo
    public function guardar(){
        
        Articulo::updateOrCreate(['id'=> $this->id_articulo],
        [
            'Nombre_articulo' => $this -> Nombre_articulo,
            'Descripcion_articulo' => $this -> Descripcion_articulo, 
            'Cantidad_articulo' => $this -> Cantidad_articulo,
        ]);

        $this->limpiarCampos();
        $this->dispatchBrowserEvent('close-modal');

        /*Articulo::updateOrCreate(['id'=> $this->id_articulo],
        [
            'Nombre_articulo' => $this -> Nombre_articulo,
            'Descripcion_articulo' => $this -> Descripcion_articulo, 
            'Cantidad_articulo' => $this -> Cantidad_articulo,
        ]);
        $this->cerrarModal();
        $this->limpiarCampos();*/
    }

    //funcioon en vista crear
    public function crear(){
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function abrirModal() {
        $this->modal = true;
    }
    public function cerrarModal() {
        $this->modal = false;
    }
    
    public function limpiarCampos(){
        $this -> Nombre_articulo = '';
        $this -> Descripcion_articulo = '';
        $this -> Cantidad_articulo = '';
        $this -> id_articulo = '';
    }

    public function editar($id){

        $articulo = Articulo::where('id', $id)->first();

        $this->id_articulo = $id;
        $this -> Nombre_articulo = $articulo->Nombre_articulo;
        $this -> Descripcion_articulo = $articulo->Descripcion_articulo;
        $this -> Cantidad_articulo = $articulo->Cantidad_articulo;
        
        $this->dispatchBrowserEvent('show-edit-student-modal');
        /*$articulo = Articulo::findOrFail($id);
        $this->id_articulo = $id;
        $this -> Nombre_articulo = $articulo->Nombre_articulo;
        $this -> Descripcion_articulo = $articulo->Descripcion_articulo;
        $this -> Cantidad_articulo = $articulo->Cantidad_articulo;
        $this->abrirModal();*/
    }

    public function borrar($id){
        Articulo::find($id)->delete();
    }


    public function ver($id){
        $articulo = Articulo::findOrFail($id);
        
        $this->abrirModal();
    }
    
    
}

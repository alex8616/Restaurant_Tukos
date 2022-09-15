<?php

namespace App\Http\Livewire;
use App\Models\Articulo;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;
use Livewire\WithPagination;

class Articulos extends Component
{
    public $id_articulo, $Nombre_articulo, $Descripcion_articulo, $Cantidad_articulo, $articulo_delete_id;
    public $view_id_articulo, $view_Nombre_articulo, $view_Descripcion_articulo, $view_Cantidad_articulo;
    public $modal = false;
    public $search;

    use WithPagination;

    public function render(){
        //$articulos = Articulo::orderBy('id','desc')->paginate(3);
        $articulos = Articulo::where('Nombre_articulo','like','%' . $this->search . '%')->get();
        return view('livewire.articulos',compact('articulos'))->extends('adminlte::page');
    }
    
    //añadir articulo
    public function guardar(){
        
        $this->validate([
            'Nombre_articulo' => 'required',
            'Descripcion_articulo' => 'required',
            'Cantidad_articulo' => 'required|numeric',
        ]);
        Articulo::updateOrCreate(['id'=> $this->id_articulo],
        [
            'Nombre_articulo' => $this -> Nombre_articulo,
            'Descripcion_articulo' => $this -> Descripcion_articulo, 
            'Cantidad_articulo' => $this -> Cantidad_articulo,
        ]);

        $this->dispatchBrowserEvent('swal');

        $this->limpiarCampos();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'Articulo Registrado Exitosamente');

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
    public function close(){
        $this->limpiarCampos();
    }
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

        $this -> id_articulo = $id;
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

    public function editArticuloData()
    {
        $this->validate([
            'Nombre_articulo' => 'required',
            'Descripcion_articulo' => 'required',
            'Cantidad_articulo' => 'required|numeric',
        ]);

        $articulo = Articulo::where('id', $this->id_articulo)->first();
        $articulo->Nombre_articulo = $this->Nombre_articulo;
        $articulo->Descripcion_articulo = $this->Descripcion_articulo;
        $articulo->Cantidad_articulo = $this->Cantidad_articulo;

        $articulo->save();
        $this->limpiarCampos();
        session()->flash('message', 'Articulo Editado Exitosamente');

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    /*
      public function borrar($id){
        Articulo::find($id)->delete();
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }
    */

    //Delete Confirmation
    public function borrar($id)
    {
        $this->articulo_delete_id = $id; //student id
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function deleteStudentData()
    {
        $articulo = Articulo::where('id', $this->articulo_delete_id)->first();
        $articulo->delete();

        session()->flash('message', 'Articulo Borrado Exitosamente');

        $this->dispatchBrowserEvent('close-modal');

        $this->articulo_delete_id = '';
    }


    public function ver($id){

        $articulo = Articulo::where('id', $id)->first();

        $this->view_id_articulo = $articulo->id;
        $this->view_Nombre_articulo = $articulo->Nombre_articulo;
        $this->view_Descripcion_articulo = $articulo->Descripcion_articulo;
        $this->view_Cantidad_articulo = $articulo->Cantidad_articulo;

        $this->dispatchBrowserEvent('show-view-student-modal');
  
    }
    
    
}

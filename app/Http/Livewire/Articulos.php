<?php

namespace App\Http\Livewire;
use App\Models\Articulo;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Articulos extends Component
{
    public $id_articulo, $image, $Nombre_articulo, $Descripcion_articulo, $Cantidad_articulo, $articulo_delete_id;
    public $view_id_articulo, $view_image, $view_Nombre_articulo, $view_Descripcion_articulo, $view_Cantidad_articulo;
    public $modal = false;
    public $search, $cambiarimgrand;

    use WithPagination;
    use WithFileUploads;

    public function mount(){
        $this->cambiarimgrand = rand();
    }
    public function render(){
        //$articulos = Articulo::orderBy('id','desc')->paginate(3);
        $articulos = Articulo::where('Nombre_articulo','like','%' . $this->search . '%')->orderBy('id','desc')->paginate(5);
        return view('livewire.articulos.articulos',compact('articulos'))->extends('adminlte::page');
    }
    
    public function guardar(){
        
        $this->validate([
            'Nombre_articulo' => 'required',
            'Descripcion_articulo' => 'required',
            'Cantidad_articulo' => 'required|numeric',
            'image' => 'nullable|image|max:2024',
        ]);

        if($this->image){
            $new = $this->image->store('articulos', 'public');
        }else{
            $new == $this->image;
        }


        Articulo::create([
            'Nombre_articulo' => $this -> Nombre_articulo,
            'Descripcion_articulo' => $this -> Descripcion_articulo, 
            'Cantidad_articulo' => $this -> Cantidad_articulo,
            'image' => $new,
        ]);
        /*
        if ($this->image->hasFile('image')) 
            $image = $this->image->store('articulos', 'public');

            //$datosPlato['imagen'] = $request->file('imagen')->store('uploads', 'public');
        
        Articulo::updateOrCreate(['id'=> $this->id_articulo],
        [
            'Nombre_articulo' => $this -> Nombre_articulo,
            'Descripcion_articulo' => $this -> Descripcion_articulo, 
            'Cantidad_articulo' => $this -> Cantidad_articulo,
            'image' => $image,
        ]);
        */

        $this->limpiarCampos();
        $this->cambiarimgrand = rand();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'Articulo Registrado Exitosamente');
    }

    public function updatingSearch(){
        $this->resetPage();
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
        $this -> image = '';
    }

    public function editar($id){

        $articulo = Articulo::where('id', $id)->first();
        
        $this -> id_articulo = $id;
        $this -> Nombre_articulo = $articulo->Nombre_articulo;
        $this -> Descripcion_articulo = $articulo->Descripcion_articulo;
        $this -> Cantidad_articulo = $articulo->Cantidad_articulo;
        $this -> image = $articulo->image;
        $this->dispatchBrowserEvent('show-edit-articulo-modal');
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
        

        if($this->image){
            $articulo->image = $this->image->store('articulos', 'public');   
        }else
            $articulo->image = $this->image;


        $articulo->save();
        $this->limpiarCampos();
        $this->cambiarimgrand = rand();
        session()->flash('message', 'Articulo Editado Exitosamente');
        $this->dispatchBrowserEvent('close-modal');
    }

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
        $this->view_image = $articulo->image;
        $this->dispatchBrowserEvent('show-view-articulo-modal');
  
    }
    
    
}

/*
<?php

namespace App\Http\Livewire;
use App\Models\Articulo;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Articulos extends Component
{
    public $id_articulo, $image, $Nombre_articulo, $Descripcion_articulo, $Cantidad_articulo, $articulo_delete_id;
    public $view_id_articulo, $view_image, $view_Nombre_articulo, $view_Descripcion_articulo, $view_Cantidad_articulo;
    public $modal = false;
    public $search, $cambiarimgrand;

    use WithPagination;
    use WithFileUploads;

    public function mount(){
        $this->cambiarimgrand = rand();
    }
    public function render(){
        //$articulos = Articulo::orderBy('id','desc')->paginate(3);
        $articulos = Articulo::where('Nombre_articulo','like','%' . $this->search . '%')->orderBy('id','desc')->paginate(5);
        return view('livewire.articulos.articulos',compact('articulos'))->extends('adminlte::page');
    }
    
    public function guardar(){
        
        $this->validate([
            'Nombre_articulo' => 'required',
            'Descripcion_articulo' => 'required',
            'Cantidad_articulo' => 'required|numeric',
            'image' => 'NULLable|image|max:2024',
        ]);
        $image = $this->image->store('articulos', 'public');
        Articulo::updateOrCreate(['id'=> $this->id_articulo],
        [
            'Nombre_articulo' => $this -> Nombre_articulo,
            'Descripcion_articulo' => $this -> Descripcion_articulo, 
            'Cantidad_articulo' => $this -> Cantidad_articulo,
            'image' => $image,
        ]);
        $this->limpiarCampos();
        $this->cambiarimgrand = rand();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'Articulo Registrado Exitosamente');
    }

    public function updatingSearch(){
        $this->resetPage();
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
        $this -> image = '';
    }

    public function editar($id){

        $articulo = Articulo::where('id', $id)->first();

        $this -> id_articulo = $id;
        $this -> Nombre_articulo = $articulo->Nombre_articulo;
        $this -> Descripcion_articulo = $articulo->Descripcion_articulo;
        $this -> Cantidad_articulo = $articulo->Cantidad_articulo;
        $this -> image = $articulo->image;
        $this->dispatchBrowserEvent('show-edit-articulo-modal');
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
        $articulo->image = $this->image;
        $articulo->save();
        $this->limpiarCampos();
        $this->cambiarimgrand = rand();
        session()->flash('message', 'Articulo Editado Exitosamente');
        $this->dispatchBrowserEvent('close-modal');
    }

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
        $this->view_image = $articulo->image;
        $this->dispatchBrowserEvent('show-view-articulo-modal');
  
    }
    
    
}

*/

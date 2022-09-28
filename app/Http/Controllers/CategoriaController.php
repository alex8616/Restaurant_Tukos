<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::orderBy('id', 'desc')->get();
        return view('admin.categoria.listar',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.create');
    }

    public function store(Request $request)
    {
        Categoria::create($request->all());
        return redirect()->route('admin.categoria.index')->with('success', 'Se registró correctamente');
   
    }

    /*
    public function edit(Categoria $categorium){
        return view('admin.categoria.edit', compact('categorium'));
        //return response()->json($categorium);
        
    }
    */

    public function updatecategoria(Request $request, $id){

        $Datoscategoria = Categoria:: findOrFail($id); 
        $Datoscategoria->Nombre_categoria = $request->Nombre_categoria;
        $Datoscategoria->save();

        return redirect()->route('admin.categoria.index')->with('update', 'Se editó correctamente');
    }

    public function destroy(Categoria $categorium){
        $item = $categorium->platos()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','No se puede eliminar, hay platos que corresponden a esta categoría.');
        }
        $categorium->delete();
        return redirect()->route('admin.categoria.index')->with('delete', 'ok');
    }
}

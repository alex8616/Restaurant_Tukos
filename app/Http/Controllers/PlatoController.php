<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;


class PlatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $platos=Plato::orderBy('id', 'desc')->get();
        $categorias = Categoria::get();
        return view('admin.plato.index',compact('platos','categorias'));
    }

    public function listar(Request $request)
    {
        $buscarpor=$request->get('buscarpor');
        $platos=Plato::where('Nombre_plato','like','%'.$buscarpor.'%')->orderBy('id', 'desc')->paginate(6);
        $categorias = new Categoria;
        return view('admin.plato.listar',compact('platos','categorias','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::get();
        return view('admin.plato.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'Nombre_plato' => 'required',
            'Precio_plato' => 'required',
            'Caracteristicas_plato' => 'required',
            'categoria_id' => 'required',
           ]);
        
         $datosPlato = request()->except('_token');
        if ($request->hasFile('imagen')) {
            $datosPlato['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        $plato = Plato::create($datosPlato);

        //return response()->json($plato);
        return redirect()->route('admin.plato.index')->with('success', 'Se registró correctamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function show(Plato $plato)
    {
        return view('admin.plato.show',compact('plato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function edit(Plato $plato)
    {
        /**
         $categorias = Categoria::get();
        return view('plato.edit', compact('plato','categorias'));
         */
    
        $categorias = Categoria::get();
        return view('admin.plato.edit',compact('plato','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosplato = request()->except(['_token', '_method']);

        if ($request->hasFile('imagen')) {
            $plato = Plato::findOrFail($id);
            Storage::delete('public/' . $plato->imagen);
            $datosplato['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }
        Plato::where('id', '=', $id)->update($datosplato);
        $plato = Plato::findOrFail($id);

        return redirect()->route('admin.plato.index')->with('actualizar', 'ok');;
    
        //return redirect()->route('plato.index')->with('update', 'Se editó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plato $plato)
    {
        $plato->delete();
        return redirect()->route('admin.plato.index')->with('eliminar', 'ok');
    }
}

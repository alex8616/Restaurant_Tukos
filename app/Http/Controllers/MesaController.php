<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Menu;
use App\Models\DetalleMenu;
use App\Models\ComandaMesa;
use App\Models\DetalleComandaMesa;
use App\Models\Plato;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas = Mesa::orderBy('id', 'desc')->get();
        return view('admin.mesa.index',compact('mesas'));
    }

    public function register(){
        return view('admin.mesa.register');
    }

    public function crear(Request $request){
        $data = request()->validate([
            'Nombre_mesa' => 'nullable|unique:mesas',
           ]);

        $datomesas = Mesa::create([
            'Nombre_mesa' => $data['Nombre_mesa'],
        ]);
        return redirect()->route('admin.mesa.index')->with('success', 'Se registró correctamente');
    }
    
    public function create(){

        $mesas = Mesa::get();
        $platos = Plato::get();
        $comandamesa = ComandaMesa::distinct('id')->get();
        $menus = Menu::select('*')
        ->join('detalle_menus', 'menus.id', '=', 'detalle_menus.menu_id')
        ->join('platos', 'platos.id', '=', 'detalle_menus.plato_id')
        ->where('Fecha_registro', '=', Carbon::now()->toDateString())->get();
        return view('admin.mesa.create',compact('menus','mesas', 'platos', 'comandamesa'));
        //return response()->json($menus);
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $comandamesa = ComandaMesa::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comandamesa->detallecomandamesas()->createMany($results);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('admin.comandamesa.index')->with('error', 'No se registro la venta, verifique los datos antes de registrar la venta');
            }
            return redirect()->route('admin.comandamesa.index')->with('success', 'Se registró la venta');
    }

    public function show(Mesa $mesa)
    {
        //
    }

    public function edit(Mesa $mesa){
        return view('admin.mesa.edit', compact('mesa'));
    }

    public function update(Request $request, Mesa $mesa){
        $mesa->update($request->all());
        return redirect()->route('admin.mesa.index')->with('update', 'Se editó correctamente');
    }

    public function destroy(Mesa $mesa){
        $item = $mesa->comandamesas()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','No se puede eliminar, hay platos que corresponden a esta categoría.');
        }
        $mesa->delete();
        return redirect()->route('admin.mesa.index')->with('delete', 'ok');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DetalleClientes;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\TipoCliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DetalleClientesController extends Controller{

    public function store(Request $request){

        $user = Auth::user();
        $tipocliente = TipoCliente::create($request->all() + [
            'user_id' => Auth::user()->id,
            'Nombre_tipoclientes' => 'Nombre_tipoclientes',
            'Direccion_tipoclientes' => 'Direccion_tipoclientes',
            'Fecha_Inicio' => 'Fecha_Inicio',
            'Fecha_Final' => 'Fecha_Final',
            'tipo' => 'tipo',
        ]);
        
        foreach($request->cliente_id as $key=>$insert){
            $results[] = array("cliente_id" => $request->cliente_id[$key]);
        }

        $tipocliente->detalleclientes()->createMany($results);
   
        return redirect()->route('admin.pensionado.index')->with('success', 'Se registró la venta');
    }

}

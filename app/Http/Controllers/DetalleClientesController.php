<?php

namespace App\Http\Controllers;

use App\Models\DetalleClientes;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\TipoCliente;

class DetalleClientesController extends Controller{

    public function store(Request $request){

        try {
            DB::beginTransaction();
            $tipocliente = TipoCliente::create($request->all() + [
            ]);
            foreach($request->cliente_id as $key=>$insert){
                $results[] = array("cliente_id" => $request->cliente_id[$key]);
            }
            $tipocliente->detalleclientes()->createMany($results);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json($tipocliente);  
        }
        return response()->json($tipocliente);  
  
        //return redirect()->route('admin.comanda.index')->with('success', 'Se registró la venta');
        //return redirect()->route('admin.pensionado.createtipo')->with('success', 'Se registró correctamente');
    }

}

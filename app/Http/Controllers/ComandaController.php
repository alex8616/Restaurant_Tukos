<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use Illuminate\Http\Request;
use App\Models\DetalleComanda;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoCliente;
use Barryvdh\DomPDF\Facade\Pdf;



class ComandaController extends Controller
{

    public function index(){
        $comandas = Comanda::orderBy('id', 'desc')->get();
        $detallecomandas = DetalleComanda::orderBy('id', 'desc')->get();
        $tipoclientes = TipoCliente::orderBy('id', 'desc')->get();
        return view ('admin.comanda.index', compact('comandas','detallecomandas','tipoclientes'));
        //return response()->json($tipoclientes);
       /*
        $comandas = Comanda::orderBy('id', 'desc')->get();
        $detallecomandas = DetalleComanda::orderBy('id', 'desc')->get();
        $tipoclientes = Cliente::select('*')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
        ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
        ->get();
        return view ('admin.comanda.index', compact('comandas','detallecomandas','tipoclientes'));
        //return response()->json($tipoclientes);
       */
    }

    public function create(){

        $clientes = Cliente::get();
        $platos = Plato::get();
        $comanda = Comanda::distinct('id')->get();
        $tipoclientes = TipoCliente::distinct('id')->get();
        return view('admin.comanda.create', compact('clientes','comanda','platos','tipoclientes'));
        //return response()->json($tipo);
    }

    public function store(Request $request){

        try {
            DB::beginTransaction();
            $user = Auth::user();
            $comanda = Comanda::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "descuento" => $request->descuento[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comanda->detallecomandas()->createMany($results);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('admin.comanda.index')->with('error', 'No se registro la venta, verifique los datos antes de registrar la venta');
            }
            return redirect()->route('admin.comanda.index')->with('success', 'Se registró la venta');
        }

    public function show(Comanda $comanda){

        $subtotal = 0;
        $detallecomandas = $comanda->detallecomandas;
        foreach ($detallecomandas as $detallecomanda) {
            $subtotal += $detallecomanda->cantidad *
            $detallecomanda->precio_venta - $detallecomanda->cantidad *
            $detallecomanda->precio_venta * $detallecomanda->descuento / 100;
        }

        return view('admin.comanda.show', compact('comanda', 'detallecomandas', 'subtotal'));
    }

    public function edit(Comanda $comanda){
        //
    }

    public function update(Request $request, Comanda $comanda){
        //
    }

    public function destroy(Comanda $comanda){
        //
    }

    public function cambio_de_estado($id){
        $comanda = Comanda::findOrFail($id);
        $comanda->estado = 'CANCELADO';
        $comanda->update();
        return redirect()->back()->with('Confirmado');
    }

    public function pdf(Comanda $comanda){

        $subtotal = 0;
        $tipoclientes = Cliente::select('*')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
        ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
        ->where('detalle_clientes.tipo_cliente_id', '=', $comanda->tipo_cliente_id)->get();
        $detallecomandas = $comanda->detallecomandas;
        foreach ($detallecomandas as $detallecomanda) {
                $subtotal += $detallecomanda->cantidad *
                $detallecomanda->precio_venta - $detallecomanda->cantidad *
                $detallecomanda->precio_venta * $detallecomanda->descuento / 100;
        }
        //return response()->json($tipoclientes);
        $pdf = PDF::loadView('admin.comanda.pdf', compact('comanda', 'subtotal', 'tipoclientes', 'detallecomandas'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$comanda->id.'pdf');
    }

    public function listapedidos(){
        /**
         SELECT COUNT(detalle_comandas.cantidad) as PlatoCantidad,comandas.id, platos.Nombre_plato, sum(detalle_comandas.cantidad) as cantidad
        FROM `comandas` 
        INNER JOIN detalle_comandas
        ON detalle_comandas.comanda_id = comandas.id
        INNER JOIN platos
        ON platos.id= detalle_comandas.plato_id
        where comandas.fecha_venta = '2022-09-06' 
        group by platos.Nombre_plato
         */
        $PedidoPlatos = DB::select('SELECT   
        sum(detalle_comandas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comandas on platos.id=detalle_comandas.plato_id 
        inner join comandas on detalle_comandas.comanda_id=comandas.id where comandas.fecha_venta = CURDATE()
        group by platos.Nombre_plato, platos.id order by sum(detalle_comandas.cantidad) desc limit 10');

        $PedidoPlatoMesas = DB::select('SELECT   
        sum(detalle_comanda_mesas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comanda_mesas on platos.id=detalle_comanda_mesas.plato_id 
        inner join comanda_mesas on detalle_comanda_mesas.comanda_mesa_id=comanda_mesas.id where comanda_mesas.fecha_venta = CURDATE()
        group by platos.Nombre_plato, platos.id order by sum(detalle_comanda_mesas.cantidad) desc limit 10');
        return view('admin.comanda.listapedidos',compact('PedidoPlatos','PedidoPlatoMesas'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ComandaMesa;
use Illuminate\Http\Request;
use App\Models\DetalleComandaMesa;
use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use App\Models\DetalleComanda;
use App\Models\DetalleMenu;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Mesa;
use Barryvdh\DomPDF\Facade\Pdf;

class ComandaMesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $comandamesas = ComandaMesa::orderBy('id', 'desc')->get();
        $detallecomandamesas = DetalleComandaMesa::orderBy('id', 'desc')->get();
        return view ('admin.comandamesa.index', compact('comandamesas','detallecomandamesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function pdf(ComandaMesa $comandaMesa){

        $subtotal = 0;
        $detallecomandamesas = $comandaMesa->detallecomandamesas;
        foreach ($detallecomandamesas as $detallecomandamesa) {
                $subtotal += $detallecomandamesa->cantidad *
                $detallecomandamesa->precio_venta - $detallecomandamesa->cantidad *
                $detallecomandamesa->precio_venta * $detallecomandamesa->descuento / 100;
        }  

        $pdf = PDF::loadView('admin.comandamesa.pdf', compact('comandaMesa', 'subtotal', 'detallecomandamesas'))
                    ->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$comandaMesa->id.'pdf');
        
        //return response()->json($detallecomandamesas);
        /**
        SELECT comanda_mesas.id, detalle_comanda_mesas.cantidad, detalle_comanda_mesas.precio_venta, detalle_comanda_mesas.comentario, comanda_mesas.total
        FROM platos
        INNER JOIN detalle_menus
        ON platos.id = detalle_menus.plato_id
        INNER JOIN menus
        ON menus.id = detalle_menus.menu_id
        INNER JOIN detalle_comanda_mesas
        ON menus.id = detalle_comanda_mesas.menu_id
        INNER JOIN comanda_mesas
        ON comanda_mesas.id = detalle_comanda_mesas.comanda_mesa_id
        INNER JOIN mesas
        ON mesas.id = comanda_mesas.mesa_id
        WHERE comanda_mesas.id = 3
        GROUP BY detalle_comanda_mesas.id
           foreach ($detallecomandamesas as $detallecomandamesa) {
                $subtotal += $detallecomandamesa->cantidad *
                $detallecomandamesa->precio_venta - $detallecomandamesa->cantidad;
        }*/
      
        /*$pdf = PDF::loadView('admin.comandamesa.pdf', compact('comandaMesa', 'subtotal', 'detallecomandamesas'))
                    ->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$comandaMesa->id.'pdf');*/    
        //dd($detallecomandamesas);
    }

    public function show(ComandaMesa $comandamesa){

        $subtotal = 0;
        $detallecomandamesas = $comandamesa->detallecomandamesas;
        foreach ($detallecomandamesas as $detallecomandamesa) {
            $subtotal += $detallecomandamesa->cantidad *
            $detallecomandamesa->precio_venta - $detallecomandamesa->cantidad *
            $detallecomandamesa->precio_venta;
        }
       // return response()->json($comandamesa);
        return view('admin.mesa.show', compact('comandamesa', 'detallecomandamesas', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComandaMesa  $comandaMesa
     * @return \Illuminate\Http\Response
     */
    public function edit(ComandaMesa $comandaMesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComandaMesa  $comandaMesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComandaMesa $comandaMesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComandaMesa  $comandaMesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComandaMesa $comandaMesa)
    {
        //
    }
}

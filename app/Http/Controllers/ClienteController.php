<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TipoCliente;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Database;
use Carbon\Carbon;
use App\Notifications\ClienteNotification;
use Illuminate\Support\Facades\Notification; 



class ClienteController extends Controller
{

    public function index(){
        $clientes = Cliente::orderBy('id', 'desc')->get();
        //auth()->user()->notify(new ClienteNotification($clientes));
        return view('admin.cliente.listar',compact('clientes'));
    }

    public function create(){
        //return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'Nombre_cliente' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
                'Apellidop_cliente' => 'nullable|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
                'Apellidom_cliente' => 'nullable',
                'Direccion_cliente' => 'nullable|max:100',
                'Celular_cliente' => 'nullable|min:8|max:12|regex:/^[+,0-9]{8,12}$/|unique:clientes',
                'Correo_cliente' => 'nullable',
                'FechaNacimiento_cliente' => 'nullable',
                'latidud' => 'nullable',
                'longitud' => 'nullable',
               ]);
    
            $datoscliente = Cliente::create([
                'Nombre_cliente' => $data['Nombre_cliente'],
                'Apellidop_cliente' => $data['Apellidop_cliente'],
                'Apellidom_cliente' => $data['Apellidom_cliente'],
                'Direccion_cliente' => $data['Direccion_cliente'],
                'Celular_cliente' => $data['Celular_cliente'],
                'FechaNacimiento_cliente' => $data['FechaNacimiento_cliente'],
                'Correo_cliente' => $data['Correo_cliente'],
                'latidud' => $data['latidud'],
                'longitud' => $data['longitud'],
            ]);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'Cliente NO Registrado');
                return redirect()->route('admin.cliente.index');
            }
                notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Articulo Registrado Correctamente');
                return redirect()->route('admin.cliente.index');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $tipoclientes = Cliente::select('*')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
        ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
        ->where('detalle_clientes.cliente_id', '=', $cliente->id)->get();
        $total_ventas = 0;
        foreach ($cliente->comandas as $key =>  $comanda) {
            $total_ventas +=$comanda->total;
        }
        return view('admin.cliente.show', compact('cliente', 'total_ventas','tipoclientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //return response()->json($cliente);
        return view('admin.cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function updatecliente(Request $request, $id){
    try {
        DB::beginTransaction();
        $datoscliente = request()->except(['_token', '_method']);

        Cliente::where('id', '=', $id)->update($datoscliente);
        $cliente = Cliente::findOrFail($id);
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        notify()->error('No Se Pudo Actualizar .. ') or notify()->error('No Se Pudo Registrar⚡️', 'Cliente NO Registrado');
        return redirect()->route('admin.cliente.index');
    }
        notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se registró correctamente ⚡️', 'Articulo Registrado Correctamente');
        return redirect()->route('admin.cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function listvip(){
        $users = User::all();
        $clientes = Cliente::where('tipo','=','SI')->get();       
        return view('admin.cliente.listvip',compact('clientes'));
    }

    public function listcumple(){
        $users = User::all();
        $news = Cliente::whereRaw("TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, CURDATE()) < TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, ADDDATE(CURDATE(), 7))")
                        ->get();
        return view('admin.cliente.listcumple', compact('news'));
    }

}

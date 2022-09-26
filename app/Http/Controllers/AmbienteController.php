<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AmbienteController extends Controller
{

    public function index(){
        $ambientes = Ambiente::orderBy('id', 'desc')->get();
        return view('admin.ambiente.index',compact('ambientes'));
    }

    public function create(){
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'Nombre_Ambiente' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
           ]);

        $datosambiente = Ambiente::create([
            'Nombre_Ambiente' => $data['Nombre_Ambiente'],
        ]);
        notify()->success('Laravel Notify is awesome!');
        return redirect()->route('admin.ambiente.index');
        //return redirect()->route('admin.ambiente.index')->with('success', 'Se registró correctamente');
    }

    public function reserva(Ambiente $ambiente,Request $request){
        $reservas = Reserva::select('*')
        ->join('ambientes', 'ambientes.id', '=', 'reservas.ambiente_id')
        ->where('reservas.ambiente_id', '=', $ambiente->id)->get();
        //return response()->json($reservas);
        return view('admin.ambiente.reserva',compact('ambiente','reservas'));
        //return response()->json($ambiente);
    }

    public function reservastore(Request $request){
        $reservado = $this->horarioReservado($request);
        if($reservado){
            return back()->with('error', 'Noce Puede Registrar Por Que Ya Hay Una RESERVA En La Hora Seleccionada');
        }else{
            $user = Auth::user();
            $reserva = Reserva::create($request->all() + [
                'user_id' => Auth::user()->id,
            ]);
            return back()->with('success', 'La Reserva Se Registro Correctamente');
            //return response()->json($request);
        }
    }
    
    public function show(Ambiente $ambiente){
       
    }

    public function edit(Ambiente $ambiente){
        return view('admin.ambiente.index', compact('ambiente'));
        //return response()->json($ambiente);
    }

    public function update(Request $request, Ambiente $ambiente){
        //
    }

    public function destroy(Ambiente $ambiente){
        $item = $ambiente->reservas()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','No se puede eliminar, Por Que Tiene RESERVACIONES registradas.');
        }
        $ambiente->delete();
        return redirect()->route('admin.ambiente.index')->with('delete', 'ok');
    }

    private function horarioReservado($request){
        $reservado = false;
        $reserva_inicial = Reserva::where('fecha',$request->fecha)
        ->where('ambiente_id',$request->ambiente_id)
        ->where('hora_inicio','<=',$request->hora_inicio)
        ->where('hora_fin','>=',$request->hora_inicio)
        ->count();
        if($reserva_inicial > 0){
            $reservado = true;
        }

        $reserva_final = Reserva::where('fecha',$request->fecha)
        ->where('ambiente_id',$request->ambiente_id)
        ->where('hora_inicio','<=',$request->hora_fin)
        ->where('hora_fin','>=',$request->hora_fin)
        ->count();
        if($reserva_final > 0){
            $reservado = true;
        }

        $reserva_inicial_final = Reserva::where('fecha',$request->fecha)
        ->where('ambiente_id',$request->ambiente_id)
        ->where('hora_inicio','>=',$request->hora_inicio)
        ->where('hora_fin','<=',$request->hora_fin)
        ->count();
        if($reserva_inicial_final > 0){
            $reservado = true;
        }

        return $reservado;
    }

}

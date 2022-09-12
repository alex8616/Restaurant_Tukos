<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleClientes extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_cliente_id',
                           'cliente_id'];

    //Relacion de uno a muchos inversa
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    //Relacion de uno a muchos inversa
    public function tipocliente(){
        return $this->belongsTo(TipoCliente::class);
    }
}

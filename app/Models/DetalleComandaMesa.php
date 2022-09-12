<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleComandaMesa extends Model
{
    use HasFactory;

    protected $fillable = ['comanda_mesa_id', 'plato_id', 'cantidad','precio_venta','descuento', 'comentario'];

    //Relacion de uno a muchos inversa
    public function comandamesa(){
        return $this->belongsTo(ComandaMesa::class);
    }

    //Relacion de uno a muchos inversa
    public function plato(){
        return $this->belongsTo(Plato::class);
    }
}

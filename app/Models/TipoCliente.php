<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;

    protected $fillable = ['Nombre_tipoclientes',
                            'Direccion_tipoclientes',
                            'Fecha_Inicio',
                            'Fecha_Final',
                            'tipo',
                            'user_id'];

    //Relacion de uno a muchos
    public function detalleclientes(){
        return $this->hasMany(DetalleClientes::class);
    }

    //Relacion uno a muchos
    public function comandas(){
        return $this->hasMany(Comanda::class);
    } 

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

}

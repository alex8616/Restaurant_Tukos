<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComandaMesa extends Model
{
    use HasFactory;
    protected $fillable = ['mesa_id','user_id','fecha_venta','total','estado'];

    //Relacion de uno a muchos inversa
    public function mesa(){
        return $this->belongsTo(Mesa::class);
    }

    //Relacion de uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos
    public function detallecomandamesas(){
        return $this->hasMany(DetalleComandaMesa::class);
    }
}

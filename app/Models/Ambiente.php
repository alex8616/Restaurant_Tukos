<?php

namespace App\Models;
use App\Models\Reserva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;

    protected $fillable = ['Nombre_Ambiente'];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
}

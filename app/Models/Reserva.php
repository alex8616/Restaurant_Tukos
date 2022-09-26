<?php

namespace App\Models;
use App\User;
use App\Models\Ambiente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = ['fecha',
                            'hora_inicio',
                            'hora_fin',
                            'motivo',
                            'ambiente_id',
                            'user_id',
                            'precio',
                            'adelanto',
                            'total'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ambiente(){
        return $this->belongsTo(Ambiente::class);
    }
}

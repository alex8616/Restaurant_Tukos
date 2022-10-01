<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RRcodigo extends Model
{
    protected $table="codigos";
    protected $fillable=[
        'fecInicio',
        'fecFinal',
        'clave',
        'autorizacion'
    ];
}

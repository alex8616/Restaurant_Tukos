<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre_articulo',
                            'Descripcion_articulo',
                            'Cantidad_articulo'];
}

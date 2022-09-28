<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $fillable = ['Empresa_Nombre',
                            'Empresa_Descripcion',
                            'Empresa_Logo',
                            'Empresa_Email',
                            'Empresa_Direccion',
                            'Empresa_Propietario',
                            'Empresa_Nit',
                            'Empresa_Telefono'];
}

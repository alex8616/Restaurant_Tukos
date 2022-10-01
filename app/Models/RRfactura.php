<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RRfactura extends Model
{
    protected $table="facturas";
    protected $fillable=[
        'idVenta',
        'codControl',
        'QR',
        'numFactura',
        'fecEmision',
        'idCodigo',
    ];
    public function Unidad()
    {
        return $this->belongsTo(RRcodigo::class, 'idCodigo');
    }
    public function Vnta()
    {
        return $this->belongsTo(Ventas::class, 'idVenta');
    }
}


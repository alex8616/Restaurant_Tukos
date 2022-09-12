<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre_mesa'];
    
    //Relacion uno a muchos
    public function comandamesas(){
        return $this->hasMany(ComandaMesa::class);
    } 

}

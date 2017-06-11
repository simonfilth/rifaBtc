<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    protected $table = 'sorteos';
    
    protected $fillable = ['fecha_sorteo','hora_sorteo','precio_sorteo','estado_sorteo'];
}

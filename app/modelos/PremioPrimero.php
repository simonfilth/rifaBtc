<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class PremioPrimero extends Model
{
    protected $table = 'premios_primero';
    
    protected $fillable = ['pago_primero'];
}

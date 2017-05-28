<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class PremioTercero extends Model
{
    protected $table = 'premios_tercero';
    
    protected $fillable = ['pago_tercero'];
}

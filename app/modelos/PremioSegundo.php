<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class PremioSegundo extends Model
{
    protected $table = 'premios_segundo';
    
    protected $fillable = ['pago_segundo'];
}

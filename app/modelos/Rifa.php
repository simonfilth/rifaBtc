<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    protected $table = 'rifas';
    
    protected $fillable = ['fecha_rifa','hora_rifa','precio_rifa'];
}

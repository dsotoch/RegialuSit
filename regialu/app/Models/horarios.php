<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horarios extends Model
{
    protected $fillable = [
        'user_id',
        'turno',
        'dia',
        'area_id',
        'horainicio',
        'horafin',
        'estado',
        'aula_id',
    ];
}

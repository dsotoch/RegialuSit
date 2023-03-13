<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asistencias extends Model
{
    protected $fillable = [
        'user_id',
        'fechaRegistro',
        'fechaActualizacion',
        'estado',
        'alumno_id',
        'aula_id',
        'area_id',
    ];
}

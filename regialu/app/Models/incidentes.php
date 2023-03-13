<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incidentes extends Model
{
    protected $fillable=['user_id',
    'alumnos_id',
    'fecha',
    'descripcion',
    'aula_id',];
}

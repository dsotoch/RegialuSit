<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumnos extends Model
{
    protected $fillable=['aula_id',
    'user_id',
    'apellidos',
    'nombres',
    'grado',
    'seccion',];
}

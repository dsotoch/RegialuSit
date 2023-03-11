<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periodos extends Model
{
    protected $fillable = [
        'user_id',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];
    public function user()
    {
        return $this->belongsTo(users::class);
    }
    public function institucion(){
        return $this->belongsTo(institucions::class);
    }}

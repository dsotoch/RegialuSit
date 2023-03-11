<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class institucions extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'direccion',
        'tipo',
        'estado',
        'id_periodo',
    ];
    public function user()
    {
        return $this->belongsTo(users::class);
    }
    public function periodo()
    {
        return $this->belongsTo(periodos::class);
    }
}

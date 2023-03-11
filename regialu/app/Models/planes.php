<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planes extends Model
{
   protected $fillable=[
    'nombre_plan',
    'precio' ,
    'estado',
   ];
   
   public function licencias(){
      return $this->hasMany(licencias::class,'plan_id','id');
  }
}

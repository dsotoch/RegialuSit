<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaccions extends Model
{
    protected $fillable = [
        'payment_id',
        'payer_id',
        'monto',
        'pagado',
        'fecha',
        'plan_id',
        'user_id',
    ];
}

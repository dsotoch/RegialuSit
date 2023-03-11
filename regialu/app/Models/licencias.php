<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class licencias extends Model
{
    protected $fillable = [
        'key',
        'user_id',
        'is_active',
        'is_usado',
        'activation_date',
        'expired_date',
    ];

}

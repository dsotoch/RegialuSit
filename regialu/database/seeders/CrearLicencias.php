<?php

namespace Database\Seeders;

use App\Models\licencias;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CrearLicencias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<200;$i++){
            licencias::create([
                'key'=>Str::random(12),
                'user_id'=>null,
                'is_active'=> false ,
                'is_usado'=>false  ,
                'activation_date'=> Carbon::now() ,
                'expired_date'=>Carbon::now(),
                ]);
        }
    }
}

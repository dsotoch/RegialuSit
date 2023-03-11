<?php

namespace Database\Seeders;

use App\Models\planes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearPlanes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        planes::create([
            'nombre_plan' => 'BASICO',
            'precio' => '10',
            'estado' => TRUE,
        ]);
        planes::create([
            'nombre_plan' => 'PREMIUN',
            'precio' => '54.9',
            'estado' => TRUE,
        ]);
        planes::create([
            'nombre_plan' => 'VIP',
            'precio' => '100.9',
            'estado' => TRUE,
        ]);
    }
}

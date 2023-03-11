<?php

namespace Database\Seeders;

use App\Models\grupos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearGrupos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        grupos::create([
            'descripcion' => 'SINLICENCIA',
           
        ]);
        grupos::create([
            'descripcion' => 'CONLICENCIA',
           

        ]);
        
    }
}

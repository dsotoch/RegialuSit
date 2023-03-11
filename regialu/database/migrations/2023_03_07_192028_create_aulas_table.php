<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\NullType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('grado');
            $table->string('seccion');
            $table->string('nivel');
            $table->string('estado')->default('Activo');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('institucion')->nullable()->references('id')->on('institucions')->onDelete(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aulas');
    }
};

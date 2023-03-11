<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->string('turno');
            $table->string('dia');
            $table->string('horainicio');
            $table->string('horafin');
            $table->string('estado')->default('Activo');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('area_id')->nullable()->references('id')->on('areas')->onDelete(null);
            $table->foreignId('aula_id')->nullable()->references('id')->on('aulas')->onDelete(null);

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
        Schema::dropIfExists('horarios');
    }
};

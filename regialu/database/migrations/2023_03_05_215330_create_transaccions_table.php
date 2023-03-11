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
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('payer_id');
            $table->double('monto');
            $table->boolean('pagado')->default(false);
            $table->date('fecha');
            $table->foreignId('plan_id')->references('id')->on('planes')->onDelete(null);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete(null);
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
        Schema::dropIfExists('transaccions');
    }
};

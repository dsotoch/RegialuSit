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
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_usado')->default(false);
            $table->date('activation_date');
            $table->date('expired_date');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('SET NULL');
            $table->foreignId('plan_id')->nullable()->references('id')->on('planes')->onDelete('SET NULL');

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
        Schema::dropIfExists('licencias');
    }
};

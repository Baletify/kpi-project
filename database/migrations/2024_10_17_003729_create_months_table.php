<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('months', function (Blueprint $table) {
            $table->id();
            $table->string('month_1');
            $table->string('month_2');
            $table->string('month_3');
            $table->string('month_4');
            $table->string('month_5');
            $table->string('month_6');
            $table->string('month_7');
            $table->string('month_8');
            $table->string('month_9');
            $table->string('month_10');
            $table->string('month_11');
            $table->string('month_12');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('months');
    }
};

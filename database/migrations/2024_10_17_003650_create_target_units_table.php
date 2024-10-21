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
        Schema::create('target_units', function (Blueprint $table) {
            $table->id();
            $table->string('target_1');
            $table->string('target_2');
            $table->string('target_3');
            $table->string('target_4');
            $table->string('target_5');
            $table->string('target_6');
            $table->string('target_7');
            $table->string('target_8');
            $table->string('target_9');
            $table->string('target_10');
            $table->string('target_11');
            $table->string('target_12');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_units');
    }
};

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
            $table->string('target_1')->nullable();
            $table->string('target_2')->nullable();
            $table->string('target_3')->nullable();
            $table->string('target_4')->nullable();
            $table->string('target_5')->nullable();
            $table->string('target_6')->nullable();
            $table->string('target_7')->nullable();
            $table->string('target_8')->nullable();
            $table->string('target_9')->nullable();
            $table->string('target_10')->nullable();
            $table->string('target_11')->nullable();
            $table->string('target_12')->nullable();
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

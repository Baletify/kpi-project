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
        Schema::create('department_targets', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('indicator');
            $table->string('calculation');
            $table->string('period');
            $table->string('unit');
            $table->string('supporting_document');
            $table->string('weighting');
            $table->string('trend')->nullable();
            $table->string('detail')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignId('target_unit_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_targets');
    }
};

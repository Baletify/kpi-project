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
        Schema::create('departement_actuals', function (Blueprint $table) {
            $table->id();
            $table->string('kpi_code');
            $table->string('kpi_item');
            $table->string('kpi_unit');
            $table->string('review_period');
            $table->string('target');
            $table->string('actual');
            $table->string('kpi_percentage');
            $table->string('kpi_calculation');
            $table->string('supporting_document')->nullable();
            $table->text('comment')->nullable();
            $table->text('record_file')->nullable();
            $table->string('department_name');
            $table->string('kpi_weighting');
            $table->dateTime('date');
            $table->string('semester');
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departement_actuals');
    }
};

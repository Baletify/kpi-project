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
        Schema::create('department_actuals', function (Blueprint $table) {
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
            $table->string('trend')->nullable();
            $table->string('status')->nullable();
            $table->string('detail')->nullable();
            $table->string('input_by')->nullable();
            $table->dateTime('input_at')->nullable();
            $table->string('asst_mng_checked_by')->nullable();
            $table->dateTime('asst_mng_checked_at')->nullable();
            $table->string('checked_by')->nullable();
            $table->dateTime('checked_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('mng_approved_by')->nullable();
            $table->string('mng_approved_at')->nullable();
            $table->string('deadline')->nullable();
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

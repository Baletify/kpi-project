<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actual extends Model
{
    use HasFactory;

    protected $fillable = [
        'kpi_code',
        'kpi_item',
        'kpi_unit',
        'review_period',
        'program_number',
        'program_file',
        'target',
        'actual',
        'kpi_percentage',
        'kpi_calculation',
        'supporting_document',
        'comment',
        'record_name',
        'record_file',
        'department_name',
        'kpi_weighting',
        'date',
        'semester',
        'employee_id',
    ];
}

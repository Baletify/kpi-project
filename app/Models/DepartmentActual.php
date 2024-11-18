<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentActual extends Model
{
    protected $fillable = [

        'kpi_code',
        'kpi_item',
        'kpi_unit',
        'review_period',
        'target',
        'actual',
        'kpi_percentage',
        'kpi_calculation',
        'supporting_document',
        'comment',
        'record_file',
        'department_name',
        'kpi_weighting',
        'date',
        'trend',
        'semester',
        'status',
        'detail',
        'department_id',
    ];
}

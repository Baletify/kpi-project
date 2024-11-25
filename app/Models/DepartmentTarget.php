<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentTarget extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentTargetFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'indicator',
        'calculation',
        'period',
        'unit',
        'supporting_document',
        'weighting',
        'trend',
        'date',
        'department_id',
        'target_unit_id',
        'detail',
    ];
}

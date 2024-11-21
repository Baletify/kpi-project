<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
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
        'employee_id',
        'target_unit_id',
        'detail',
    ];
}

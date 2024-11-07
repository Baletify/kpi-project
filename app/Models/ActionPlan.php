<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    /** @use HasFactory<\Database\Factories\ActionPlanFactory> */
    use HasFactory;

    protected $fillable = ['employee_id', 'file_name', 'file'];
}

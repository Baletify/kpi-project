<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeptActionPlan extends Model
{
    protected $fillable = ['department_id', 'file_name', 'file'];
}

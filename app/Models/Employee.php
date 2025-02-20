<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'occupation',
        'status',
        'email',
        'password',
        'grade',
        'phone',
        'input_type',
        'role',
        'is_active',
        'created_at',
        'updated_at',
        'department_id',
    ];
}

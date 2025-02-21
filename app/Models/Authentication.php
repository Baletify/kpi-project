<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Authentication extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'input_type',
        'occupation',
        'is_active',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // /**
    //  * Automatically hash the password when it is set.
    //  *
    //  * @param string $password
    //  * @return void
    //  */
    // public function setPasswordAttribute($password)
    // {
    //     Log::info('setPasswordAttribute called with: ' . $password);
    //     $this->attributes['password'] = bcrypt($password);
    // }
}

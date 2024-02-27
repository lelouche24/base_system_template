<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use HasFactory;
    protected $table = 'admin';
    protected $guard = 'admin';

    protected $fillable = [
        'username',
        'slug',
        'firstname',
        'middlename',
        'lastname',
        'fullname',
        'password',
        'user_type',
        'status',
        'department',
        'position',
        'user_roles',
    ];

    protected $hidden = [
        'password',
    ];
}

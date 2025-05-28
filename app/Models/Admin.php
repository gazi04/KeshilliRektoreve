<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory, Authenticatable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'lastname',
        'phoneNumber',
        'email',
        'address',
        'isActive',
        'username',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

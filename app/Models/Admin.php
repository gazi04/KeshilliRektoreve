<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use Authenticatable, HasFactory;

    protected $table = 'admins';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'lastname',
        'phoneNumber',
        'email',
        'address',
        'isActive',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'isActive' => 'boolean',
    ];
}

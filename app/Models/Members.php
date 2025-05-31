<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    /** @use HasFactory<\Database\Factories\MembersFactory> */
    use HasFactory;
        protected $fillable = [
        'title',
        'name',
        'position',
        'email',
        'orderNr',
        'imageUrl',
    ];

    protected $casts = [
        'orderNr' => 'integer',
    ];

}

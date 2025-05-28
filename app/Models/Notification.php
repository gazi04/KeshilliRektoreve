<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    protected $fillable = [
        'imageUrl',
        'datetime',
        'title',
        'description',
        'notificationType',
    ];

    protected $casts = [
        'datetime' => 'datetime',
    ];
}

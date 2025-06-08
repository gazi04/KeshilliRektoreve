<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    /** @use HasFactory<\Database\Factories\ConferenceFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'description',
        'isActive',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'id');
    }

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'isActive' => 'boolean',
        ];
    }
}

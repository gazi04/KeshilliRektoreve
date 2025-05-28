<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'type',
        'conferenceId',
    ];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }
}

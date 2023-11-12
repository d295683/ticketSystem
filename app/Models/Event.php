<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'datetime' => 'datetime',
        'location' => 'string',
        'price' => 'double',
        'image_url' => 'string',
        'tickets' => 'integer',
        'tickets_sold' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

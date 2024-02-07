<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VkEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'type',
        'version',
        'group_id',
        'object',
        'is_processed',
        'attempts',
    ];
}

<?php

namespace App\Models\VK;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class VkEvent extends Model
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

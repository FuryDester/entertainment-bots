<?php

namespace App\Models\GroupBoss;

use App\Models\Common\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class GroupBoss extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'post_id',
        'post_content',
        'image',
        'max_health',
        'current_health',
        'base_hit_chance',
        'hit_cooldown',
        'miss_cooldown',
        'killed_by',
        'killed_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function groupBossWeapons(): HasMany
    {
        return $this->hasMany(GroupBossWeapon::class);
    }
}

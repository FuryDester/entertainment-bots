<?php

namespace App\Models\GroupBoss;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class GroupBossWeapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_boss_id',
        'name',
        'hit_damage_template',
        'min_damage',
        'max_damage',
        'hit_chance',
    ];

    public function groupBoss(): BelongsTo
    {
        return $this->belongsTo(GroupBoss::class);
    }

    public function groupBossUserActions(): HasMany
    {
        return $this->hasMany(GroupBossUserAction::class);
    }
}

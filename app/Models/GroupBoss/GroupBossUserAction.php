<?php

namespace App\Models\GroupBoss;

use App\Models\Common\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class GroupBossUserAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_boss_id',
        'group_boss_weapon_id',
        'damage',
        'is_miss',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function groupBoss(): BelongsTo
    {
        return $this->belongsTo(GroupBoss::class);
    }

    public function groupBossWeapon(): BelongsTo
    {
        return $this->belongsTo(GroupBossWeapon::class);
    }
}

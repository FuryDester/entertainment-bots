<?php

namespace App\Infrastructure\GroupBoss\Enums;

enum GroupBossTagsEnum: string
{
    case GroupBossRepository = 'group_boss_repository';
    case GroupBossUserActionRepository = 'group_boss_user_action_repository';
    case GroupBossWeaponRepository = 'group_boss_weapon_repository';
}

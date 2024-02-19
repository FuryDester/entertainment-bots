<?php

namespace App\Domain\GroupBoss\Services;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;

interface GroupBossTemplatorContract
{
    /**
     * Формирование сообщения о нанесении урона.
     * @param int $damage Нанесенный урон.
     * @param GroupBossWeaponDTO $weapon Оружие, которым был нанесен урон.
     * @return string Сообщение о нанесении урона.
     */
    public function finalizeDamageMessage(int $damage, GroupBossWeaponDTO $weapon, GroupBossDTO $boss): string;

    /**
     * Получение базового сообщения о нанесении урона.
     */
    public function getBaseDamageMessageTemplate(int $damage, GroupBossWeaponDTO $weapon, GroupBossDTO $boss): string;

    /**
     * Формирование поста группового босса.
     */
    public function finalizeBossPost(GroupBossDTO $boss): string;
}

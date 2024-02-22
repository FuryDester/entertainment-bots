<?php

namespace App\Application\GroupBoss\Services;

use App\Domain\Common\Services\Templator\BaseTemplatorServiceContract;
use App\Domain\GroupBoss\Services\GroupBossTemplatorContract;
use App\Infrastructure\Common\Traits\WordDeclension;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossDTO;
use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossWeaponDTO;

final readonly class GroupBossTemplator implements GroupBossTemplatorContract
{
    use WordDeclension;

    public function __construct(
        private BaseTemplatorServiceContract $baseTemplator,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function finalizeDamageMessage(int $damage, GroupBossWeaponDTO $weapon, GroupBossDTO $boss): string
    {
        $damage = abs($damage);

        $data = [
            'damage' => $damage,
            'damage_declension' => $this->declension($damage, ['', 'а', 'а']),
            'health' => $boss->getCurrentHealth(),
        ];

        return $this->baseTemplator->render(
            $weapon->getHitDamageTemplate() ?: $this->getBaseDamageMessageTemplate($damage, $weapon, $boss),
            $data,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getBaseDamageMessageTemplate(int $damage, GroupBossWeaponDTO $weapon, GroupBossDTO $boss): string
    {
        return sprintf(
            'Вы попали по боссу и нанесли %d единиц%s урон. Осталось %d единиц%s здоровья.',
            abs($damage),
            $this->declension(abs($damage), ['у', 'ы', '']),
            $boss->getCurrentHealth(),
            $this->declension($boss->getCurrentHealth(), ['а', 'ы', '']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function finalizeBossPost(GroupBossDTO $boss): string
    {
        $data = [
            'name' => $boss->getName(),
            'health' => $boss->getCurrentHealth(),
            'max_health' => $boss->getMaxHealth(),
            'hit_chance' => $boss->getBaseHitChance(),
        ];

        return $this->baseTemplator->render($boss->getPostContent(), $data);
    }
}

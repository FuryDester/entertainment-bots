<?php

namespace App\Domain\Common\Requests;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

interface ShouldFormDTO
{
    /**
     * Метод для формирования ДТО по запросу с реквеста
     */
    public function formDto(): AbstractDTO;
}

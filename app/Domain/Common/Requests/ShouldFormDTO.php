<?php

namespace App\Domain\Common\Requests;

use App\Infrastructure\Common\DataTransferObjects\BaseDTO;

interface ShouldFormDTO
{
    /**
     * Метод для формирования ДТО по запросу с реквеста
     *
     * @return BaseDTO
     */
    public function formDto(): BaseDTO;
}

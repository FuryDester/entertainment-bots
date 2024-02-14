<?php

namespace App\Domain\Common\Factories\Models;

use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use Illuminate\Support\Carbon;

interface UserDTOFactoryContract
{
    /**
     * @param array{
     *     id?: int,
     *     vk_user_id: int,
     *     vk_peer_id: int,
     *     is_admin: bool,
     *     state: string,
     *     data?: array,
     *     last_activity_at?: Carbon|string,
     *     created_at?: Carbon|string,
     *     updated_at?: Carbon|string,
     * } $data
     */
    public static function createFromData(array $data): UserDTO;
}

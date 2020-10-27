<?php

declare(strict_types=1);

namespace App\Rooms;

interface RoomInterface
{
    public function isWalkableAt(int $x, int $y): bool;
}

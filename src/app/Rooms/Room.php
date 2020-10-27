<?php

declare(strict_types=1);

namespace App\Rooms;

class Room implements RoomInterface
{
    private int $width;
    private int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    private function getWidth(): int
    {
        return $this->width;
    }

    private function getHeight(): int
    {
        return $this->height;
    }

    public function isWalkableAt(int $x, int $y): bool
    {
        if (
            $x < 0
            || $y < 0
            || $x >= $this->getWidth()
            || $y >= $this->getHeight()
        ) {
            return false;
        }

        return true;
    }
}

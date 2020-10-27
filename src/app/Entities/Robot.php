<?php

declare(strict_types=1);

namespace App\Entities;

use App\Rooms\RoomInterface;

class Robot implements EntityInterface, ControllableInterface
{
    public const DIRECTION_NORTH = 'N';
    public const DIRECTION_SOUTH = 'S';
    public const DIRECTION_EAST = 'E';
    public const DIRECTION_WEST = 'W';

    private const DIRECTIONS = [
        self::DIRECTION_NORTH,
        self::DIRECTION_EAST,
        self::DIRECTION_SOUTH,
        self::DIRECTION_WEST,
    ];

    private const LEFT = -1;
    private const RIGHT = 1;

    private int $x;
    private int $y;
    private string $direction;
    private RoomInterface $room;

    public function __construct(
        int $x,
        int $y,
        string $direction,
        RoomInterface $room
    ) {
        $this->setX($x);
        $this->setY($y);
        $this->setDirection($direction);
        $this->setRoom($room);
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): void
    {
        if (!in_array($direction, self::DIRECTIONS)) {
            throw new \InvalidArgumentException('Invalid direction: ' . $direction);
        }

        $this->direction = $direction;
    }

    public function getRoom(): RoomInterface
    {
        return $this->room;
    }

    public function setRoom(RoomInterface $room): void
    {
        $this->room = $room;
    }

    public function moveForwards(): void
    {
        $deltaX = 0;
        $deltaY = 0;
        switch ($this->getDirection()) {
            case self::DIRECTION_NORTH:
                $deltaY = -1;
                break;
            case self::DIRECTION_SOUTH:
                $deltaY = 1;
                break;
            case self::DIRECTION_EAST:
                $deltaX = 1;
                break;
            case self::DIRECTION_WEST:
                $deltaX = -1;
                break;
        }

        $this->move($deltaX, $deltaY);
    }

    private function move(int $deltaX, int $deltaY): void
    {
        $newX = $this->getX() + $deltaX;
        $newY = $this->getY() + $deltaY;
        $room = $this->getRoom();
        if (!$room->isWalkableAt($newX, $newY)) {
            return;
        }

        $this->setX($newX);
        $this->setY($newY);
    }

    public function turnLeft(): void
    {
        $this->turn(self::LEFT);
    }

    public function turnRight(): void
    {
        $this->turn(self::RIGHT);
    }

    private function turn(int $direction): void
    {
        $indexOfCurrentDirection = array_search($this->getDirection(), self::DIRECTIONS);
        $deltaIndex = $indexOfCurrentDirection + $direction;
        if ($deltaIndex > count(self::DIRECTIONS) - 1) {
            $deltaIndex = 0;
        } elseif ($deltaIndex < 0) {
            $deltaIndex = count(self::DIRECTIONS) - 1;
        }

        $newDirection = self::DIRECTIONS[$deltaIndex];

        $this->setDirection($newDirection);
    }
}

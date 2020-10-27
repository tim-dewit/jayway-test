<?php

declare(strict_types=1);

use App\Rooms\Room;
use App\Rooms\RoomInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Rooms\Room
 */
class RoomTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testRoomImplementsWalkableInterface(): void
    {
        $room = new Room(1, 1);

        $this->assertInstanceOf(RoomInterface::class, $room);
    }

    /**
     * @covers ::__construct
     * @covers ::isWalkableAt
     * @covers ::getWidth
     * @covers ::getHeight
     */
    public function testIsWalkableAtReturnsFalseWhenCoordinatesAreOutsideOfRoom(): void
    {
        $room = new Room(3, 3);

        $this->assertFalse($room->isWalkableAt(-1, -1));
        $this->assertFalse($room->isWalkableAt(4, 4));
        $this->assertFalse($room->isWalkableAt(3, 3));
    }

    /**
     * @covers ::__construct
     * @covers ::isWalkableAt
     * @covers ::getWidth
     * @covers ::getHeight
     */
    public function testIsWalkableAtReturnsTrueForCoordinatesWithinRoom(): void
    {
        $room = new Room(3, 3);

        $this->assertTrue($room->isWalkableAt(0, 0));
        $this->assertTrue($room->isWalkableAt(2, 2));
    }
}

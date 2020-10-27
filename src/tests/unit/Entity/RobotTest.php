<?php

declare(strict_types=1);

use App\Entities\ControllableInterface;
use App\Entities\EntityInterface;
use App\Entities\Robot;
use App\Rooms\RoomInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Entities\Robot
 */
class RobotTest extends TestCase
{
    private Robot $robot;

    protected function setUp(): void
    {
        $roomMock = $this->createMock(RoomInterface::class);
        $roomMock->method('isWalkableAt')->willReturn(true);

        $this->robot = new Robot(
            0,
            0,
            Robot::DIRECTION_NORTH,
            $roomMock
        );
    }

    /**
     * @covers ::__construct
     */
    public function testRobotImplementsEntityAndControllableInterfaces(): void
    {
        $this->assertInstanceOf(EntityInterface::class, $this->robot);
        $this->assertInstanceOf(ControllableInterface::class, $this->robot);
    }

    /**
     * @covers ::__construct
     * @covers ::getX
     * @covers ::setX
     */
    public function testGetAndSetX(): void
    {
        $x = $this->robot->getX();

        $this->assertSame(0, $x);

        $this->robot->setX(10);
        $x = $this->robot->getX();

        $this->assertSame(10, $x);
    }

    /**
     * @covers ::__construct
     * @covers ::getY
     * @covers ::setY
     */
    public function testGetAndSetY(): void
    {
        $y = $this->robot->getY();

        $this->assertSame(0, $y);

        $this->robot->setY(10);
        $y = $this->robot->getY();

        $this->assertSame(10, $y);
    }

    /**
     * @covers ::__construct
     * @covers ::getDirection
     * @covers ::setDirection
     */
    public function testGetAndSetDirection(): void
    {
        $direction = $this->robot->getDirection();

        $this->assertSame(Robot::DIRECTION_NORTH, $direction);

        $this->robot->setDirection(Robot::DIRECTION_SOUTH);
        $direction = $this->robot->getDirection();

        $this->assertSame(Robot::DIRECTION_SOUTH, $direction);
    }

    /**
     * @covers ::setDirection
     */
    public function testSetDirectionThrowsExceptionIfInvalidDirectionIsProvided(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid direction: foo');

        $this->robot->setDirection('foo');
    }

    /**
     * @covers ::moveForwards
     * @covers ::move
     */
    public function testMoveForwardsTowardsNorth(): void
    {
        $this->assertSame(0, $this->robot->getX());
        $this->assertSame(0, $this->robot->getY());
        $this->assertSame(Robot::DIRECTION_NORTH, $this->robot->getDirection());

        $this->robot->moveForwards();

        $this->assertSame(0, $this->robot->getX());
        $this->assertSame(-1, $this->robot->getY());
    }

    /**
     * @covers ::moveForwards
     * @covers ::move
     */
    public function testMoveForwardsTowardsSouth(): void
    {
        $this->assertSame(0, $this->robot->getX());
        $this->assertSame(0, $this->robot->getY());

        $this->robot->setDirection(Robot::DIRECTION_SOUTH);
        $this->robot->moveForwards();

        $this->assertSame(0, $this->robot->getX());
        $this->assertSame(1, $this->robot->getY());
    }

    /**
     * @covers ::moveForwards
     * @covers ::move
     */
    public function testMoveForwardsTowardsEast(): void
    {
        $this->assertSame(0, $this->robot->getX());
        $this->assertSame(0, $this->robot->getY());

        $this->robot->setDirection(Robot::DIRECTION_EAST);
        $this->robot->moveForwards();

        $this->assertSame(1, $this->robot->getX());
        $this->assertSame(0, $this->robot->getY());
    }

    /**
     * @covers ::moveForwards
     * @covers ::move
     */
    public function testMoveForwardsTowardsWest(): void
    {
        $this->assertSame(0, $this->robot->getX());
        $this->assertSame(0, $this->robot->getY());

        $this->robot->setDirection(Robot::DIRECTION_WEST);
        $this->robot->moveForwards();

        $this->assertSame(-1, $this->robot->getX());
        $this->assertSame(0, $this->robot->getY());
    }

    /**
     * @covers ::moveForwards
     * @covers ::move
     */
    public function testMoveForwardsDoesNothingIfNewPositionIsNotWalkable(): void
    {
        $roomMock = $this->createMock(RoomInterface::class);
        $roomMock->method('isWalkableAt')->willReturn(false);
        $this->robot->setRoom($roomMock);

        $robotX = $this->robot->getX();
        $robotY = $this->robot->getY();

        $this->robot->moveForwards();

        $this->assertSame($robotX, $this->robot->getX());
        $this->assertSame($robotY, $this->robot->getY());
    }

    /**
     * @covers ::turnLeft
     * @covers ::turn
     */
    public function testTurnLeft(): void
    {
        $this->assertSame(Robot::DIRECTION_NORTH, $this->robot->getDirection());

        $this->robot->turnLeft();
        $this->assertSame(Robot::DIRECTION_WEST, $this->robot->getDirection());

        $this->robot->turnLeft();
        $this->assertSame(Robot::DIRECTION_SOUTH, $this->robot->getDirection());

        $this->robot->turnLeft();
        $this->assertSame(Robot::DIRECTION_EAST, $this->robot->getDirection());

        $this->robot->turnLeft();
        $this->assertSame(Robot::DIRECTION_NORTH, $this->robot->getDirection());
    }

    /**
     * @covers ::turnRight
     * @covers ::turn
     */
    public function testTurnRight(): void
    {
        $this->assertSame(Robot::DIRECTION_NORTH, $this->robot->getDirection());

        $this->robot->turnRight();
        $this->assertSame(Robot::DIRECTION_EAST, $this->robot->getDirection());

        $this->robot->turnRight();
        $this->assertSame(Robot::DIRECTION_SOUTH, $this->robot->getDirection());

        $this->robot->turnRight();
        $this->assertSame(Robot::DIRECTION_WEST, $this->robot->getDirection());

        $this->robot->turnRight();
        $this->assertSame(Robot::DIRECTION_NORTH, $this->robot->getDirection());
    }
}

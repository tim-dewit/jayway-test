<?php

declare(strict_types=1);

use App\Commands\InitializeRobotCommand;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Commands\InitializeRobotCommand
 */
class InitializeRobotCommandTest extends TestCase
{
    /**
     * @covers ::parse
     * @covers ::validate
     * @covers ::getX
     * @covers ::getY
     * @covers ::getDirection
     * @covers ::setX
     * @covers ::setY
     * @covers ::setDirection
     */
    public function testConstruct(): void
    {
        $initializeRobotCommand = new InitializeRobotCommand('1 4 N');

        $this->assertSame(1, $initializeRobotCommand->getX());
        $this->assertSame(4, $initializeRobotCommand->getY());
        $this->assertSame('N', $initializeRobotCommand->getDirection());
    }

    /**
     * @covers ::parse
     * @covers ::validate
     * @covers ::getDirection
     * @covers ::setDirection
     */
    public function testDirectionGetsConvertedToUpperCase(): void
    {
        $initializeRobotCommand = new InitializeRobotCommand('1 4 s');

        $this->assertSame('S', $initializeRobotCommand->getDirection());
    }

    /**
     * @covers ::validate
     */
    public function testConstructThrowsExceptionOnInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new InitializeRobotCommand('foo');
    }
}

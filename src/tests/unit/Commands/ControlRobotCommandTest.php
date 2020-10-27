<?php

declare(strict_types=1);

namespace App\Commands;

use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Commands\ControlRobotCommand
 */
class ControlRobotCommandTest extends TestCase
{
    /**
     * @covers ::parse
     * @covers ::validate
     * @covers ::getControlSequence
     * @covers ::setControlSequence
     */
    public function testConstruct(): void
    {
        $controlSequence = 'LFFRFRFRFF';
        $controlRobotCommand = new ControlRobotCommand($controlSequence);

        $this->assertSame($controlSequence, $controlRobotCommand->getControlSequence());
    }

    /**
     * @covers ::parse
     * @covers ::validate
     * @covers ::getControlSequence
     * @covers ::setControlSequence
     */
    public function testControlSequenceGetsConvertedToUpperCase(): void
    {
        $controlRobotCommand = new ControlRobotCommand('lfr');

        $this->assertSame('LFR', $controlRobotCommand->getControlSequence());
    }

    /**
     * @covers ::validate
     */
    public function testConstructThrowsExceptionOnInvalidInput(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ControlRobotCommand('foo');
    }
}

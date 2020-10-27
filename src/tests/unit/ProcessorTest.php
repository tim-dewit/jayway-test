<?php

declare(strict_types=1);

namespace App;

use App\Entities\ControllableInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Processor
 */
class ProcessorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::process
     * @covers ::handleCommand
     * @covers ::getCommandSequence
     * @covers ::getControllable
     */
    public function testProcessHandlesTurnLeftCommand(): void
    {
        $controllableSpy = $this->createMock(ControllableInterface::class);
        $controllableSpy->expects($this->once())->method('turnLeft');

        $processor = new Processor($controllableSpy, Processor::COMMAND_TURN_LEFT);
        $processor->process();
    }

    /**
     * @covers ::__construct
     * @covers ::process
     * @covers ::handleCommand
     * @covers ::getCommandSequence
     * @covers ::getControllable
     */
    public function testProcessHandlesTurnRightCommand(): void
    {
        $controllableSpy = $this->createMock(ControllableInterface::class);
        $controllableSpy->expects($this->once())->method('turnRight');

        $processor = new Processor($controllableSpy, Processor::COMMAND_TURN_RIGHT);
        $processor->process();
    }

    /**
     * @covers ::__construct
     * @covers ::process
     * @covers ::handleCommand
     * @covers ::getCommandSequence
     * @covers ::getControllable
     */
    public function testProcessHandlesMoveForwardsCommand(): void
    {
        $controllableSpy = $this->createMock(ControllableInterface::class);
        $controllableSpy->expects($this->once())->method('moveForwards');

        $processor = new Processor($controllableSpy, Processor::COMMAND_MOVE_FORWARDS);
        $processor->process();
    }

    /**
     * @covers ::__construct
     * @covers ::process
     * @covers ::handleCommand
     * @covers ::getCommandSequence
     * @covers ::getControllable
     */
    public function testProcessHandlesCommandSequence(): void
    {
        $controllableSpy = $this->createMock(ControllableInterface::class);
        $controllableSpy->expects($this->exactly(2))->method('turnLeft');
        $controllableSpy->expects($this->once())->method('turnRight');
        $controllableSpy->expects($this->once())->method('moveForwards');

        $processor = new Processor($controllableSpy, 'LLRF');
        $processor->process();
    }
}

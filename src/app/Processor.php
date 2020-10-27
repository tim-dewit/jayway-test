<?php

declare(strict_types=1);

namespace App;

use App\Entities\ControllableInterface;

class Processor
{
    public const COMMAND_TURN_LEFT = 'L';
    public const COMMAND_TURN_RIGHT = 'R';
    public const COMMAND_MOVE_FORWARDS = 'F';

    private ControllableInterface $controllable;
    private string $commandSequence;

    public function __construct(
        ControllableInterface $controllable,
        string $commandSequence
    ) {
        $this->controllable = $controllable;
        $this->commandSequence = $commandSequence;
    }

    private function getControllable(): ControllableInterface
    {
        return $this->controllable;
    }

    private function getCommandSequence(): string
    {
        return $this->commandSequence;
    }

    public function process(): void
    {
        $commandSequence = $this->getCommandSequence();
        for ($index = 0; $index < strlen($commandSequence); $index++) {
            $command = $commandSequence[$index];
            $this->handleCommand($command);
        }
    }

    private function handleCommand(string $command): void
    {
        $controllable = $this->getControllable();
        switch ($command) {
            case self::COMMAND_TURN_LEFT:
                $controllable->turnLeft();
                break;
            case self::COMMAND_TURN_RIGHT:
                $controllable->turnRight();
                break;
            case self::COMMAND_MOVE_FORWARDS:
                $controllable->moveForwards();
                break;
            default:
                throw new \InvalidArgumentException('Invalid command: ' . $command);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Commands;

class ControlRobotCommand extends AbstractCommand
{
    protected string $validInputRegex = '/^(L|R|F)+$/i';

    private string $controlSequence;

    public function getControlSequence(): string
    {
        return $this->controlSequence;
    }

    private function setControlSequence(string $controlSequence): void
    {
        $this->controlSequence = strtoupper($controlSequence);
    }

    protected function parse(): void
    {
        $this->setControlSequence($this->command);
    }
}

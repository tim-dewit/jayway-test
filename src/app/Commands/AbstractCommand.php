<?php

declare(strict_types=1);

namespace App\Commands;

abstract class AbstractCommand
{
    protected string $validInputRegex;
    protected string $command;

    public function __construct(string $command)
    {
        $this->command = $command;
        if (!$this->isCommandValid()) {
            throw new \InvalidArgumentException(
                'Invalid input for ' . static::class . ': ' . $this->command
            );
        }

        $this->parse();
    }

    private function isCommandValid(): bool
    {
        return preg_match($this->validInputRegex, $this->command) === 1;
    }

    abstract protected function parse(): void;
}

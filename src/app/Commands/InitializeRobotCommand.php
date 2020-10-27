<?php

declare(strict_types=1);

namespace App\Commands;

class InitializeRobotCommand extends AbstractCommand
{
    protected string $validInputRegex = '/^(?<x>\d+) (?<y>\d+) (?<direction>N|S|E|W)$/i';

    private int $x;
    private int $y;
    private string $direction;

    protected function parse(): void
    {
        $matches = null;
        preg_match($this->validInputRegex, $this->command, $matches);

        $this->setX((int) $matches['x']);
        $this->setY((int) $matches['y']);
        $this->setDirection($matches['direction']);
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
        $this->direction = strtoupper($direction);
    }
}

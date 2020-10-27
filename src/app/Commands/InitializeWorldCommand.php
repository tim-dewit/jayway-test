<?php

declare(strict_types=1);

namespace App\Commands;

class InitializeWorldCommand extends AbstractCommand
{
    protected string $validInputRegex = '/^(?<width>\d+) (?<height>\d+)$/';

    private int $width;
    private int $height;

    public function getWidth(): int
    {
        return $this->width;
    }

    private function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    private function setHeight(int $height): void
    {
        $this->height = $height;
    }

    protected function parse(): void
    {
        $matches = null;
        preg_match($this->validInputRegex, $this->command, $matches);

        $this->setWidth((int) $matches['width']);
        $this->setHeight((int) $matches['height']);
    }
}

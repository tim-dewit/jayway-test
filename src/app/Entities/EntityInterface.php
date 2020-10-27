<?php

declare(strict_types=1);

namespace App\Entities;


interface EntityInterface
{
    public function getX(): int;
    public function getY(): int;
    public function getDirection(): string;
}

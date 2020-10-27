<?php

declare(strict_types=1);

namespace App\Entities;

interface ControllableInterface
{
    public function turnLeft(): void;
    public function turnRight(): void;
    public function moveForwards(): void;
}

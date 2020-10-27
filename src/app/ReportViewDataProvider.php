<?php

declare(strict_types=1);

namespace App;

use App\Entities\EntityInterface;

class ReportViewDataProvider
{
    public function buildReport(EntityInterface $entity): string
    {
        return "X: {$entity->getX()}, Y: {$entity->getY()}, Direction: {$entity->getDirection()}";
    }
}

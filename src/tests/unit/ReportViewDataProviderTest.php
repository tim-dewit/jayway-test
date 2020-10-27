<?php

declare(strict_types=1);

namespace App;

use App\Entities\EntityInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\ReportViewDataProvider
 */
class ReportViewDataProviderTest extends TestCase
{
    /**
     * @covers ::buildReport
     */
    public function testBuildReport(): void
    {
        $entityMock = $this->createMock(EntityInterface::class);
        $entityMock->method('getX')->willReturn(1);
        $entityMock->method('getY')->willReturn(2);
        $entityMock->method('getDirection')->willReturn('N');

        $reportViewDataProvider = new ReportViewDataProvider();
        $report = $reportViewDataProvider->buildReport($entityMock);

        $this->assertSame('X: 1, Y: 2, Direction: N', $report);
    }
}

<?php

declare(strict_types=1);

namespace App;

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * @dataProvider runDataProvider
     */
    public function testRun(string $command, string $expectedOutput): void
    {
        $application = new Application($command);
        $output = $application->run();

        $this->assertSame($expectedOutput, $output);
    }

    public function runDataProvider(): array
    {
        return [
            ["5 5\n1 2 N\nRFRFFRFRF", 'X: 1, Y: 3, Direction: N'],
            ["5 5\n0 0 E\nRFLFFLRF", 'X: 3, Y: 1, Direction: E'],
            ["foo", 'Invalid command'],
        ];
    }
}

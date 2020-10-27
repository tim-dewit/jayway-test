<?php

declare(strict_types=1);

use App\Commands\AbstractCommand;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Commands\AbstractCommand
 */
class AbstractCommandTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::validate
     */
    public function testConstructThrowsExceptionIfInputIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new class('foo') extends AbstractCommand
        {
            protected string $validInputRegex = '/\d/';

            protected function parse(): void
            {
            }
        };

    }
}

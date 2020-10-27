<?php

declare(strict_types=1);

use App\Commands\InitializeWorldCommand;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Commands\InitializeWorldCommand
 */
class InitializeWorldCommandTest extends TestCase
{
    /**
     * @covers ::validate
     * @covers ::parse
     * @covers ::getWidth
     * @covers ::getHeight
     * @covers ::setWidth
     * @covers ::setHeight
     */
    public function testConstruct(): void
    {
        $command = '2 4';
        $initializeWorldCommand = new InitializeWorldCommand($command);

        $this->assertSame(2, $initializeWorldCommand->getWidth());
        $this->assertSame(4, $initializeWorldCommand->getHeight());
    }

    /**
     * @covers ::validate
     */
    public function testConstructThrowsExceptionOnInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new InitializeWorldCommand('foo');
    }
}

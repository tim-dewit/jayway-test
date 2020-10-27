<?php

declare(strict_types=1);

namespace App;

use App\Commands\ControlRobotCommand;
use App\Commands\InitializeRobotCommand;
use App\Commands\InitializeWorldCommand;
use App\Entities\Robot;
use App\Rooms\Room;

class Application
{
    private ReportViewDataProvider $reportViewDataProvider;
    private string $input;

    public function __construct(string $input)
    {
        $this->input = $input;
        $this->reportViewDataProvider = new ReportViewDataProvider();
    }

    public function run(): string
    {
        try {
            $commands = explode("\n", $this->input);
            $trimmedCommands = array_map('trim', $commands);
            $initializeWorldCommand = new InitializeWorldCommand($trimmedCommands[0]);
            $initializeRobotCommand = new InitializeRobotCommand($trimmedCommands[1]);
            $controlRobotCommand = new ControlRobotCommand($trimmedCommands[2]);
        } catch (\InvalidArgumentException $exception) {
            return 'Invalid command';
        }

        $room = new Room($initializeWorldCommand->getWidth(), $initializeWorldCommand->getHeight());
        $robot = new Robot(
            $initializeRobotCommand->getX(),
            $initializeRobotCommand->getY(),
            $initializeRobotCommand->getDirection(),
            $room
        );
        $processor = new Processor($robot, $controlRobotCommand->getControlSequence());
        $processor->process();

        return $this->reportViewDataProvider->buildReport($robot);
    }
}

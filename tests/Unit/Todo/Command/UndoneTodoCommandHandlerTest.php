<?php

declare(strict_types=1);

namespace Unit\Todo\Command;

use App\Application\Todo\Command\UndoneTodoCommand;
use App\Application\Todo\CommandHandler\UndoneTodoCommandHandler;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UndoneTodoCommandHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $command = new UndoneTodoCommand(1);

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('save');

        $repository->expects($this->once())
            ->method('get')
            ->willReturn(new Todo(
                1,
                'Test title',
                'Test description'
            ));

        $handler = new UndoneTodoCommandHandler($repository);
        $todo = $handler($command);

        $this->assertFalse($todo->isDone());
        $this->assertNull($todo->getDoneAt());
    }
}

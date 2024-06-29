<?php

declare(strict_types=1);

namespace Unit\Todo\Command;

use App\Application\Todo\Command\CreateTodoCommand;
use App\Application\Todo\CommandHandler\CreateTodoCommandHandler;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CreateTodoCommandHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $command = new CreateTodoCommand('Test title', 'Test description');

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('save');

        $handler = new CreateTodoCommandHandler($repository);
        $todo = $handler($command);

        $this->assertSame('Test title', $todo->getTitle());
        $this->assertSame('Test description', $todo->getDescription());
        $this->assertFalse($todo->isDone());
    }
}

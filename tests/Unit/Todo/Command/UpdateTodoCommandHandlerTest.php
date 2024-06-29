<?php

declare(strict_types=1);

namespace Unit\Todo\Command;

use App\Application\Todo\Command\UpdateTodoCommand;
use App\Application\Todo\CommandHandler\UpdateTodoCommandHandler;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class UpdateTodoCommandHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $command = new UpdateTodoCommand(1, 'Test title', 'Test description');

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('get')
            ->willReturn(new Todo(
                1,
                'Test title',
                'Test description'
            ));

        $handler = new UpdateTodoCommandHandler($repository);
        $todo = $handler($command);

        $this->assertSame('Test title', $todo->getTitle());
        $this->assertSame('Test description', $todo->getDescription());
        $this->assertFalse($todo->isDone());
    }
}

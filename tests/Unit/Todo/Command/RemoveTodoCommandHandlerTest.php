<?php

declare(strict_types=1);

namespace Unit\Todo\Command;

use App\Application\Todo\Command\RemoveTodoCommand;
use App\Application\Todo\CommandHandler\RemoveTodoCommandHandler;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class RemoveTodoCommandHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $command = new RemoveTodoCommand(1);

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->method('get')
            ->willReturn(new Todo(1, 'Test'));

        $repository->expects($this->once())
            ->method('remove');

        $handler = new RemoveTodoCommandHandler($repository);
        $handler($command);
    }
}

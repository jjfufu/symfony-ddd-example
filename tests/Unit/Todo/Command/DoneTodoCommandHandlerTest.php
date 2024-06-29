<?php

declare(strict_types=1);

namespace Unit\Todo\Command;

use App\Application\Todo\Command\DoneTodoCommand;
use App\Application\Todo\CommandHandler\DoneTodoCommandHandler;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class DoneTodoCommandHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $command = new DoneTodoCommand(1);

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

        $handler = new DoneTodoCommandHandler($repository);
        $todo = $handler($command);

        $this->assertTrue($todo->isDone());
        $this->assertNotNull($todo->getDoneAt());
    }
}

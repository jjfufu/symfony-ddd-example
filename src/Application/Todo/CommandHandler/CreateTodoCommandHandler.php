<?php

declare(strict_types=1);

namespace App\Application\Todo\CommandHandler;

use App\Application\Todo\Command\CreateTodoCommand;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\CommandHandlerInterface;

final readonly class CreateTodoCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(CreateTodoCommand $command): Todo
    {
        $todo = new Todo(
            0, // id is auto-generated
            $command->getTitle(),
            $command->getDescription()
        );

        $this->todoRepository->save($todo);

        return $todo;
    }
}

<?php

declare(strict_types=1);

namespace App\Application\Todo\CommandHandler;

use App\Application\Todo\Command\UpdateTodoCommand;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\CommandHandlerInterface;

final readonly class UpdateTodoCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(UpdateTodoCommand $command): Todo
    {
        $todo = $this->todoRepository->get($command->getId());

        $todo->rename($command->getTitle());
        $todo->setDescription($command->getDescription());

        $this->todoRepository->save($todo);

        return $todo;
    }
}

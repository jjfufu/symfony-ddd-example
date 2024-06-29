<?php

declare(strict_types=1);

namespace App\Application\Todo\CommandHandler;

use App\Application\Todo\Command\UndoneTodoCommand;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\CommandHandlerInterface;

final readonly class UndoneTodoCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(UndoneTodoCommand $command): ?Todo
    {
        $todo = $this->todoRepository->get($command->getId());

        if (null === $todo) {
            return null;
        }

        $todo->markUndone();
        $this->todoRepository->save($todo);

        return $todo;
    }
}

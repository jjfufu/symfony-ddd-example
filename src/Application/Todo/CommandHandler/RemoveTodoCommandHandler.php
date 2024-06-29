<?php

declare(strict_types=1);

namespace App\Application\Todo\CommandHandler;

use App\Application\Todo\Command\RemoveTodoCommand;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\CommandHandlerInterface;

final readonly class RemoveTodoCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(RemoveTodoCommand $command): void
    {
        $todo = $this->todoRepository->get($command->getId());

        if (null === $todo) {
            return;
        }

        $this->todoRepository->remove($todo);
    }
}

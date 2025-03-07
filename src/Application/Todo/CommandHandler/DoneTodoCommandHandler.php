<?php

declare(strict_types=1);

namespace App\Application\Todo\CommandHandler;

use App\Application\Todo\Command\DoneTodoCommand;
use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\CommandHandlerInterface;

final readonly class DoneTodoCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(DoneTodoCommand $command): Todo
    {
        $todo = $this->todoRepository->get($command->getId());
        $todo->markDone();
        $this->todoRepository->save($todo);

        return $todo;
    }
}

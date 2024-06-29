<?php

declare(strict_types=1);

namespace App\Application\Todo\QueryHandler;

use App\Application\Todo\Query\CountDoneTodoQuery;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\QueryHandlerInterface;

final readonly class CountDoneTodoQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(CountDoneTodoQuery $query): int
    {
        return $this->todoRepository->countDone();
    }
}

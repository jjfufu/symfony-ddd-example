<?php

declare(strict_types=1);

namespace App\Application\Todo\QueryHandler;

use App\Application\Todo\Query\CountUndoneTodoQuery;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\QueryHandlerInterface;

final readonly class CountUndoneTodoQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(CountUndoneTodoQuery $query): int
    {
        return $this->todoRepository->countUndone();
    }
}

<?php

declare(strict_types=1);

namespace App\Application\Todo\QueryHandler;

use App\Application\Todo\Query\AllTodoQuery;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use App\Infrastructure\Messenger\QueryHandlerInterface;

final readonly class AllTodoQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private TodoRepositoryInterface $todoRepository
    ) {
    }

    public function __invoke(AllTodoQuery $query): array
    {
        return $this->todoRepository->all();
    }
}

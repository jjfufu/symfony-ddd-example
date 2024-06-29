<?php

declare(strict_types=1);

namespace Unit\Todo\Query;

use App\Application\Todo\Query\AllTodoQuery;
use App\Application\Todo\QueryHandler\AllTodoQueryHandler;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class AllTodoQueryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $query = new AllTodoQuery();

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('all')
            ->willReturn([]);

        $handler = new AllTodoQueryHandler($repository);
        $todos = $handler($query);

        $this->assertIsArray($todos);
    }
}

<?php

declare(strict_types=1);

namespace Unit\Todo\Query;

use App\Application\Todo\Query\CountUndoneTodoQuery;
use App\Application\Todo\QueryHandler\CountUndoneTodoQueryHandler;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CountUndoneTodoQueryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $query = new CountUndoneTodoQuery();

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('countUndone')
            ->willReturn(1);

        $handler = new CountUndoneTodoQueryHandler($repository);
        $count = $handler($query);

        $this->assertEquals(1, $count);
    }
}

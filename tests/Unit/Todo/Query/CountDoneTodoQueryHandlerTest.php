<?php

declare(strict_types=1);

namespace Unit\Todo\Query;

use App\Application\Todo\Query\CountDoneTodoQuery;
use App\Application\Todo\QueryHandler\CountDoneTodoQueryHandler;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CountDoneTodoQueryHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $query = new CountDoneTodoQuery();

        $repository = $this->createMock(TodoRepositoryInterface::class);

        $repository->expects($this->once())
            ->method('countDone')
            ->willReturn(1);

        $handler = new CountDoneTodoQueryHandler($repository);
        $count = $handler($query);

        $this->assertEquals(1, $count);
    }
}

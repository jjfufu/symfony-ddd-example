<?php

declare(strict_types=1);

namespace App\Application\Todo;

use App\Application\Todo\View\TodoView;
use App\Domain\Todo\Model\Todo;

final class TodoViewTransformer
{
    public function transform(Todo $todo): TodoView
    {
        return new TodoView(
            $todo->getId(),
            $todo->getTitle(),
            $todo->getDescription(),
            $todo->isDone(),
            $todo->getCreatedAt()->format('Y-m-d H:i:s'),
            $todo->getDoneAt()?->format('Y-m-d H:i:s')
        );
    }
}

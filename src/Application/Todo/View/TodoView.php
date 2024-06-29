<?php

declare(strict_types=1);

namespace App\Application\Todo\View;

final class TodoView
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public bool $done,
        public string $createdAt,
        public ?string $doneAt
    ) {
    }
}

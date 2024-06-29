<?php

declare(strict_types=1);

namespace App\Application\Todo\Command;

use App\Infrastructure\Messenger\CommandInterface;

abstract readonly class WriteTodoCommand implements CommandInterface
{
    public function __construct(
        private string $title,
        private ?string $description = null
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}

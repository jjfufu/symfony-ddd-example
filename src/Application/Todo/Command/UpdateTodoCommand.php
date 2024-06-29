<?php

declare(strict_types=1);

namespace App\Application\Todo\Command;

use App\Application\Shared\IdCommandTrait;

final readonly class UpdateTodoCommand extends WriteTodoCommand
{
    use IdCommandTrait;

    public function __construct(
        private int $id,
        string $title,
        ?string $description = null
    ) {
        parent::__construct($title, $description);
    }
}

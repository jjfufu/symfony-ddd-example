<?php

declare(strict_types=1);

namespace App\Application\Shared;

use App\Infrastructure\Messenger\CommandInterface;

readonly class IdCommand implements CommandInterface
{
    use IdCommandTrait;

    public function __construct(
        private int $id
    ) {
    }
}

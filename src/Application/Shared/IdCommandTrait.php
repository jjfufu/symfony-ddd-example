<?php

declare(strict_types=1);

namespace App\Application\Shared;

trait IdCommandTrait
{
    public function getId(): int
    {
        return $this->id;
    }
}

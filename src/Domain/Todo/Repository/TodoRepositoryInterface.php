<?php

declare(strict_types=1);

namespace App\Domain\Todo\Repository;

use App\Domain\Todo\Model\Todo;

interface TodoRepositoryInterface
{
    public function save(Todo $todo): void;

    public function remove(Todo $todo): void;

    public function get(int $id): ?Todo;

    public function all(): array;

    public function allDone(): array;

    public function allUndone(): array;

    public function count(): int;

    public function countDone(): int;

    public function countUndone(): int;

    public function paginate(int $page, int $perPage): array;
}

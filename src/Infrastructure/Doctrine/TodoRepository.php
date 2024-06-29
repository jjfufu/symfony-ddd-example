<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Todo\Model\Todo;
use App\Domain\Todo\Repository\TodoRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class TodoRepository implements TodoRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(Todo $todo): void
    {
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }

    public function remove(Todo $todo): void
    {
        $this->entityManager->remove($todo);
        $this->entityManager->flush();
    }

    public function get(int $id): ?Todo
    {
        return $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Todo::class, 't')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function all(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Todo::class, 't')
            ->getQuery()
            ->getResult();
    }

    public function allDone(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Todo::class, 't')
            ->where('t.done = true')
            ->getQuery()
            ->getResult();
    }

    public function allUndone(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Todo::class, 't')
            ->where('t.done = false')
            ->getQuery()
            ->getResult();
    }

    public function count(): int
    {
        return $this->entityManager->createQueryBuilder()
            ->select('count(t.id)')
            ->from(Todo::class, 't')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countDone(): int
    {
        return $this->entityManager->createQueryBuilder()
            ->select('count(t.id)')
            ->from(Todo::class, 't')
            ->where('t.done = true')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function countUndone(): int
    {
        return $this->entityManager->createQueryBuilder()
            ->select('count(t.id)')
            ->from(Todo::class, 't')
            ->where('t.done = false')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function paginate(int $page, int $perPage): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Todo::class, 't')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage)
            ->getQuery()
            ->getResult();
    }
}

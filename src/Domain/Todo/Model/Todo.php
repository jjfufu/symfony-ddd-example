<?php

declare(strict_types=1);

namespace App\Domain\Todo\Model;

class Todo
{
    private string $title;
    private ?string $description;
    private bool $done = false;
    private \DateTimeImmutable $createdAt;
    private ?\DateTimeImmutable $doneAt = null;

    public function __construct(
        private int $id,
        string $title,
        ?string $description = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function rename(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDoneAt(): ?\DateTimeImmutable
    {
        return $this->doneAt;
    }

    public function isDone(): bool
    {
        return $this->done;
    }

    public function markDone(): void
    {
        $this->done = true;
        $this->doneAt = new \DateTimeImmutable();
    }

    public function markUndone(): void
    {
        $this->done = false;
        $this->doneAt = null;
    }
}

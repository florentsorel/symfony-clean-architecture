<?php

declare(strict_types=1);

namespace Domain\Actor;

use Cake\Chronos\ChronosInterface;

final class Actor
{
    private ?int $id;

    private string $name;

    private bool $isActive;

    private ChronosInterface $creationDate;

    private ?ChronosInterface $lastUpdateDate = null;

    public static function create(
        string $name,
        bool $active,
        ChronosInterface $creationDate,
        ?ChronosInterface $lastUpdateDate = null
    ): self {
        $actor = new self();
        $actor->name = $name;
        $actor->isActive = $active;
        $actor->creationDate = $creationDate;
        $actor->lastUpdateDate = $lastUpdateDate;

        return $actor;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function active(): bool
    {
        return $this->isActive;
    }

    public function creationDate(): ChronosInterface
    {
        return $this->creationDate;
    }

    public function lastUpdateDate(): ?ChronosInterface
    {
        return $this->lastUpdateDate;
    }
}

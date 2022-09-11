<?php

declare(strict_types=1);

namespace Domain\Actor;

use Cake\Chronos\ChronosInterface;
use Domain\Shared\Domain;

final class Actor implements Domain
{
    private ?int $id;

    private string $name;

    private bool $isActive;

    private ChronosInterface $creationDate;

    private ?ChronosInterface $lastUpdateDate = null;

    public static function create(
        int $id,
        string $name,
        bool $active,
        ChronosInterface $creationDate,
        ?ChronosInterface $lastUpdateDate
    ): self {
        $actor = new self();
        $actor->id = $id;
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

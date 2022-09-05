<?php

namespace Domain\Actor;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;

final class Actor
{
    private string $name;

    private bool $active;

    private ChronosInterface $creationDate;

    private ?ChronosInterface $lastUpdateDate;

    public static function create(
        string $name,
        bool $active
    ): self {
        $actor = new self();
        $actor->name = $name;
        $actor->active = $active;
        $actor->creationDate = Chronos::now();

        return $actor;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getCreationDate(): ChronosInterface
    {
        return $this->creationDate;
    }

    public function getLastUpdateDate(): ?ChronosInterface
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(?ChronosInterface $lastUpdateDate): void
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }
}

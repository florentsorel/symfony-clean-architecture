<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\View\Actor;

use Cake\Chronos\ChronosInterface;
use Domain\Actor\Actor;

final class ActorView
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly bool $isActive,
        private readonly ChronosInterface $creationDate,
        private readonly ?ChronosInterface $lastUpdateDate
    ) {
    }

    public static function fromDomain(Actor $actor): self
    {
        return new self(
            $actor->getId(),
            $actor->name(),
            $actor->active(),
            $actor->creationDate(),
            $actor->lastUpdateDate()
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getCreationDate(): ChronosInterface
    {
        return $this->creationDate;
    }

    public function getLastUpdateDate(): ?ChronosInterface
    {
        return $this->lastUpdateDate;
    }
}

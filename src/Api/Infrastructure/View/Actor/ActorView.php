<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\View\Actor;

use Domain\Actor\Actor as DomainActor;

class ActorView
{
    public function __construct(
        private readonly DomainActor $actor
    ) {
    }

    public function getId(): int
    {
        return $this->actor->getId();
    }

    public function getName(): string
    {
        return $this->actor->name();
    }

    public function isActive(): bool
    {
        return $this->actor->active();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'active' => $this->isActive(),
        ];
    }
}

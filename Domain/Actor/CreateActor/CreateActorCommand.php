<?php

declare(strict_types=1);

namespace Domain\Actor\CreateActor;

use Domain\Shared\Bus\Command\Command;

final class CreateActorCommand implements Command
{
    public function __construct(
        private readonly string $name,
        private readonly bool $active
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}

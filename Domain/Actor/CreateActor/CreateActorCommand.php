<?php

declare(strict_types=1);

namespace Domain\Actor\CreateActor;

use Domain\Shared\Bus\Command\Command;
use Symfony\Component\HttpFoundation\InputBag;

final class CreateActorCommand implements Command
{
    public function __construct(
        private readonly string $name,
        private readonly bool $active
    ) {
    }

    public static function fromRequest(InputBag $request): self
    {
        return new self(
            $request->get('name'),
            1 === (int) $request->get('active'),
        );
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

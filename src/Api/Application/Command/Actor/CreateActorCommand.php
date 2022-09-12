<?php

namespace App\Api\Application\Command\Actor;

use Symfony\Component\HttpFoundation\InputBag;

class CreateActorCommand
{
    private function __construct(private readonly string $name, private readonly bool $active)
    {
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

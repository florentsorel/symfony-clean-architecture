<?php

declare(strict_types=1);

namespace Domain\Actor\CreateActor;

use Domain\Shared\Bus\Command\Command;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class CreateActorCommand implements Command
{
    public function __construct(
        #[NotBlank(normalizer: 'trim')]
        private readonly string $name,
        #[Type('bool')]
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

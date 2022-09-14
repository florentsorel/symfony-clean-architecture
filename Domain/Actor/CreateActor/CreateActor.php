<?php

declare(strict_types=1);

namespace Domain\Actor\CreateActor;

use Cake\Chronos\Chronos;
use Domain\Actor\Actor as DomainActor;
use Domain\Actor\ActorRepositoryInterface;
use Domain\Shared\Bus\Command\CommandHandler;

final class CreateActor implements CommandHandler
{
    public function __construct(
        private readonly ActorRepositoryInterface $actorRepository
    ) {
    }

    public function __invoke(CreateActorCommand $command): DomainActor
    {
        $domainActor = DomainActor::create(
            $command->getName(),
            $command->isActive(),
            Chronos::now()
        );

        $this->actorRepository->add($domainActor, true);

        return $domainActor;
    }
}

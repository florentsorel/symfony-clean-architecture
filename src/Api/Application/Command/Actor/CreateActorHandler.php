<?php

namespace App\Api\Application\Command\Actor;

use App\Shared\Infrastructure\Doctrine\DataTransformer\ActorTransformer;
use App\Shared\Infrastructure\Doctrine\Repository\ActorRepository;
use Cake\Chronos\Chronos;
use Domain\Actor\Actor as DomainActor;

class CreateActorHandler
{
    public function __construct(
        private readonly ActorTransformer $actorTransformer,
        private readonly ActorRepository $actorRepository
    ) {
    }

    public function handle(CreateActorCommand $command): DomainActor
    {
        $domainActor = DomainActor::create(
            $command->getName(),
            $command->isActive(),
            Chronos::now()
        );

        $actor = $this->actorTransformer->toEntity($domainActor);

        $this->actorRepository->add($actor, true);

        $domainActor->setId($actor->getId());

        return $domainActor;
    }
}

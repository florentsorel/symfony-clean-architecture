<?php

declare(strict_types=1);

namespace Domain\Actor\GetActorById;

use Domain\Actor\ActorNotFoundException;
use Domain\Actor\ActorRepositoryInterface;
use Domain\Shared\Bus\Query\QueryHandler;

final class GetActorById implements QueryHandler
{
    public function __construct(private readonly ActorRepositoryInterface $actorRepository)
    {
    }

    public function __invoke(ActorId $query): GetActorByIdResponse
    {
        $actor = $this->actorRepository->findActorById($query->actorId);

        if (null === $actor) {
            throw new ActorNotFoundException(sprintf('Actor with identifier %d was not found', $query->actorId));
        }

        return new GetActorByIdResponse($actor);
    }
}

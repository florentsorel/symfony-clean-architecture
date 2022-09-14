<?php

declare(strict_types=1);

namespace Domain\Actor\GetActorById;

use Domain\Actor\Actor;
use Domain\Actor\ActorGateway;
use Domain\Shared\Bus\Query\QueryHandler;

final class GetActorById implements QueryHandler
{
    public function __construct(private readonly ActorGateway $actorGateway)
    {
    }

    public function __invoke(ActorId $query): ?Actor
    {
        return $this->actorGateway->getActorById($query->actorId);
    }
}

<?php

declare(strict_types=1);

namespace Domain\Actor\GetActorById;

use Domain\Shared\Bus\Query\Query;

final class ActorId implements Query
{
    public function __construct(public readonly int $actorId)
    {
    }
}

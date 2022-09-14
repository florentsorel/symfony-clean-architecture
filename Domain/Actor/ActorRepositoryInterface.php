<?php

declare(strict_types=1);

namespace Domain\Actor;

use Domain\Shared\Repository;

interface ActorRepositoryInterface extends Repository
{
    public function findActorById(int $actorId): ?Actor;
}

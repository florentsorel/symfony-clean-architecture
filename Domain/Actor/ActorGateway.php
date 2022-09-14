<?php

declare(strict_types=1);

namespace Domain\Actor;

use Domain\Shared\Gateway;

interface ActorGateway extends Gateway
{
    public function getActorById(int $actorId): ?Actor;
}

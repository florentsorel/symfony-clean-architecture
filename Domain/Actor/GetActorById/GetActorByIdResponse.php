<?php

declare(strict_types=1);

namespace Domain\Actor\GetActorById;

use Domain\Actor\Actor;

class GetActorByIdResponse
{
    public function __construct(private readonly Actor $actor)
    {
    }

    public function getActor(): Actor
    {
        return $this->actor;
    }
}

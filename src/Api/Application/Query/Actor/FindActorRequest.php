<?php

declare(strict_types=1);

namespace App\Api\Application\Query\Actor;

class FindActorRequest
{
    public function __construct(private readonly int $actorId)
    {
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }
}

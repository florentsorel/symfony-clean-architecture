<?php

declare(strict_types=1);

namespace App\Api\Application\Query;

use App\Api\Infrastructure\View\Actor\ActorView;

class FindActorResponse
{
    public function __construct(private readonly ActorView $actorView)
    {
    }

    public function getActorView(): ActorView
    {
        return $this->actorView;
    }
}

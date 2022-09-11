<?php

declare(strict_types=1);

namespace App\Api\Application\Query;

use App\Api\Infrastructure\Finder\Actor\ActorFinder;
use Doctrine\ORM\EntityNotFoundException;

class FindActorQuery
{
    public function __construct(private readonly ActorFinder $actorFinder)
    {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function handle(FindActorRequest $request): FindActorResponse
    {
        $actorView = $this->actorFinder->findById($request->getActorId());

        return new FindActorResponse($actorView);
    }
}

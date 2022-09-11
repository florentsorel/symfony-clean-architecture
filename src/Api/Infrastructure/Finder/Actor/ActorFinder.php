<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Finder\Actor;

use App\Api\Infrastructure\View\Actor\ActorView;
use App\Shared\Infrastructure\Doctrine\DataTransformer\ActorTransformer;
use App\Shared\Infrastructure\Doctrine\Repository\ActorRepository;
use Doctrine\ORM\EntityNotFoundException;

class ActorFinder
{
    public function __construct(
        private readonly ActorRepository $actorRepository,
        private readonly ActorTransformer $actorTransformer
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function findById(int $actorId): ActorView
    {
        $actor = $this->actorRepository->find($actorId);

        if (null === $actor) {
            throw new EntityNotFoundException(sprintf('Actor with identifier %d was not found', $actorId));
        }

        $actorDomain = $this->actorTransformer->toDomain($actor);

        return new ActorView($actorDomain);
    }
}

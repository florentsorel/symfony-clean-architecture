<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\DataTransformer;

use App\Shared\Infrastructure\Doctrine\Entity\Actor as EntityActor;
use Domain\Actor\Actor as DomainActor;
use InvalidArgumentException;

final class ActorTransformer implements EntityTransformer
{
    public function toDomain($entity): DomainActor
    {
        if (!$entity instanceof EntityActor) {
            $type = is_object($entity)
                ? get_class($entity)
                : gettype($entity);

            throw new InvalidArgumentException(sprintf('%s expected; "%s" given', EntityActor::class, $type));
        }

        return DomainActor::create(
            $entity->getId(),
            $entity->getName(),
            $entity->isActive(),
            $entity->getCreationDate(),
            $entity->getLastUpdateDate()
        );
    }
}

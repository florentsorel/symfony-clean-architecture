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

        $domainActor = DomainActor::create(
            $entity->getName(),
            $entity->isActive(),
            $entity->getCreationDate(),
            $entity->getLastUpdateDate()
        );

        $domainActor->setId($entity->getId());

        return $domainActor;
    }

    public function toEntity($domain, $target = null): EntityActor
    {
        if (!$domain instanceof DomainActor) {
            $type = is_object($domain)
                ? get_class($domain)
                : gettype($domain);

            throw new InvalidArgumentException(sprintf('%s expected; "%s" given', DomainActor::class, $type));
        }

        if (null !== $target && !$target instanceof EntityActor) {
            $type = is_object($target)
                ? get_class($target)
                : gettype($target);

            throw new InvalidArgumentException(sprintf('%s expected; "%s" given', EntityActor::class, $type));
        }

        if (null === $target) {
            $target = new EntityActor();
        }

        $target->setName($domain->name())
            ->setIsActive($domain->active())
            ->setCreationDate($domain->creationDate())
            ->setLastUpdateDate($domain->lastUpdateDate())
        ;

        return $target;
    }
}

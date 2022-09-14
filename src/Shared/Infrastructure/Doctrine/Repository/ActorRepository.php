<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Repository;

use App\Shared\Infrastructure\Doctrine\DataTransformer\ActorTransformer;
use App\Shared\Infrastructure\Doctrine\Entity\Actor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Actor\Actor as DomainActor;
use Domain\Actor\ActorRepositoryInterface;

/**
 * @extends ServiceEntityRepository<Actor>
 *
 * @method Actor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actor[]    findAll()
 * @method Actor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorRepository extends ServiceEntityRepository implements ActorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private readonly ActorTransformer $actorTransformer)
    {
        parent::__construct($registry, Actor::class);
    }

    public function add(DomainActor $actor, bool $flush = false): void
    {
        $entity = $this->actorTransformer->toEntity($actor);
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
            $actor->setId($entity->getId());
        }
    }

    public function remove(DomainActor $actor, bool $flush = false): void
    {
        $entity = $this->actorTransformer->toEntity($actor);
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findActorById(int $actorId): ?DomainActor
    {
        $actorEntity = $this->find($actorId);

        if (null === $actorEntity) {
            return null;
        }

        return $this->actorTransformer->toDomain($actorEntity);
    }
}

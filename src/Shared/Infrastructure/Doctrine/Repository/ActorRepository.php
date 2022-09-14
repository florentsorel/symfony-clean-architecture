<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Repository;

use App\Shared\Infrastructure\Doctrine\DataTransformer\ActorTransformer;
use App\Shared\Infrastructure\Doctrine\Entity\Actor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Actor\Actor as DomainActor;
use Domain\Actor\ActorGateway;

/**
 * @extends ServiceEntityRepository<Actor>
 *
 * @method Actor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actor[]    findAll()
 * @method Actor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorRepository extends ServiceEntityRepository implements ActorGateway
{
    public function __construct(ManagerRegistry $registry, private readonly ActorTransformer $actorTransformer)
    {
        parent::__construct($registry, Actor::class);
    }

    public function add(Actor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Actor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getActorById(int $actorId): ?DomainActor
    {
        $actorEntity = $this->find($actorId);

        if (null === $actorEntity) {
            return null;
        }

        return $this->actorTransformer->toDomain($actorEntity);
    }
}

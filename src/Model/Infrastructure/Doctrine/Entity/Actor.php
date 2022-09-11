<?php

declare(strict_types=1);

namespace App\Model\Infrastructure\Doctrine\Entity;

use App\Model\Infrastructure\Doctrine\Repository\ActorRepository;
use Cake\Chronos\Chronos;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idActor')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private string $name;

    #[ORM\Column]
    private bool $isActive;

    #[ORM\Column(type: 'datetime_immutable')]
    private Chronos $creationDate;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private Chronos $lastUpdateDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreationDate(): Chronos
    {
        return $this->creationDate;
    }

    #[ORM\PrePersist]
    public function setCreationDateValue(): void
    {
        $this->creationDate = Chronos::now();
    }

    public function getLastUpdateDate(): ?Chronos
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(?Chronos $lastUpdateDate): self
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }
}

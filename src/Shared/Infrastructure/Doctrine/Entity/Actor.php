<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Entity;

use App\Shared\Infrastructure\Doctrine\Repository\ActorRepository;
use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idActor')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private string $name;

    #[ORM\Column]
    private bool $isActive;

    #[ORM\Column(type: 'chronos')]
    private ChronosInterface $creationDate;

    #[ORM\Column(type: 'chronos', nullable: true)]
    private ?ChronosInterface $lastUpdateDate;

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

    public function getCreationDate(): ChronosInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(ChronosInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreationDateValue(): void
    {
        $this->creationDate = Chronos::now();
    }

    public function getLastUpdateDate(): ?ChronosInterface
    {
        return $this->lastUpdateDate;
    }

    public function setLastUpdateDate(?ChronosInterface $lastUpdateDate): self
    {
        $this->lastUpdateDate = $lastUpdateDate;

        return $this;
    }
}

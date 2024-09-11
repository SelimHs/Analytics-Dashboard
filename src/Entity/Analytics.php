<?php

namespace App\Entity;

use App\Repository\AnalyticsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnalyticsRepository::class)]
class Analytics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idUser = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $firstVisit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastVisit = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastSubmit = null;

    #[ORM\Column]
    private ?int $nbrVisits = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrSubmits = null;

    #[ORM\Column(length: 150)]
    private ?string $lastIP = null;

    #[ORM\Column(type: 'string', length: 150)]
    private ?string $lp_source = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstVisit(): ?\DateTimeInterface
    {
        return $this->firstVisit;
    }

    public function setFirstVisit(\DateTimeInterface $firstVisit): static
    {
        $this->firstVisit = $firstVisit;

        return $this;
    }

    public function getLastVisit(): ?\DateTimeInterface
    {
        return $this->lastVisit;
    }

    public function setLastVisit(\DateTimeInterface $lastVisit): static
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    public function getLastSubmit(): ?\DateTimeInterface
    {
        return $this->lastSubmit;
    }

    public function setLastSubmit(?\DateTimeInterface $lastSubmit): static
    {
        $this->lastSubmit = $lastSubmit;

        return $this;
    }

    public function getNbrVisits(): ?int
    {
        return $this->nbrVisits;
    }

    public function setNbrVisits(int $nbrVisits): static
    {
        $this->nbrVisits = $nbrVisits;

        return $this;
    }

    public function getNbrSubmits(): ?int
    {
        return $this->nbrSubmits;
    }

    public function setNbrSubmits(?int $nbrSubmits): static
    {
        $this->nbrSubmits = $nbrSubmits;

        return $this;
    }

    public function getLastIP(): ?string
    {
        return $this->lastIP;
    }

    public function setLastIP(string $lastIP): static
    {
        $this->lastIP = $lastIP;

        return $this;
    }

    
    public function getLpSource(): ?string
    {
        return $this->lp_source;
    }

    public function setLpSource(?string $lp_source): self
    {
        $this->lp_source = $lp_source;

        return $this;
    }
}

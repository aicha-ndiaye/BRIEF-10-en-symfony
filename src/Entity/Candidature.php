<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CandidatureRepository::class)]
#[Broadcast]
class Candidature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'candidature', targetEntity: Formation::class, orphanRemoval: true)]
    private Collection $Formation;

    #[ORM\ManyToOne(inversedBy: 'candidatures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $Users = null;

    public function __construct()
    {
        $this->Formation = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormation(): Collection
    {
        return $this->Formation;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->Formation->contains($formation)) {
            $this->Formation->add($formation);
            $formation->setCandidature($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->Formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getCandidature() === $this) {
                $formation->setCandidature(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(?Users $Users): static
    {
        $this->Users = $Users;

        return $this;
    }
}

   

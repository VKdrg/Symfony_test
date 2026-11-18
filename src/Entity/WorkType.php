<?php

namespace App\Entity;

use App\Repository\WorkTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkTypeRepository::class)]
class WorkType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, WorkPiece>
     */
    #[ORM\OneToMany(targetEntity: WorkPiece::class, mappedBy: 'workType')]
    #[ORM\JoinTable(name: 'Work_Piece')]
    private Collection $workPieces;

    public function __construct()
    {
        $this->workPieces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, WorkPiece>
     */
    public function getWorkPieces(): Collection
    {
        return $this->workPieces;
    }

    public function addWorkPiece(WorkPiece $workPiece): static
    {
        if (!$this->workPieces->contains($workPiece)) {
            $this->workPieces->add($workPiece);
            $workPiece->setWorkType($this);
        }

        return $this;
    }

    public function removeWorkPiece(WorkPiece $workPiece): static
    {
        if ($this->workPieces->removeElement($workPiece)) {
            // set the owning side to null (unless already changed)
            if ($workPiece->getWorkType() === $this) {
                $workPiece->setWorkType(null);
            }
        }

        return $this;
    }
}

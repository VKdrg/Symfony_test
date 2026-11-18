<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, WorkPiece>
     */
    #[ORM\ManyToMany(targetEntity: WorkPiece::class, mappedBy: 'category')]
    private Collection $workPieces;

    public function __construct()
    {
        $this->workPieces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $workPiece->addCategory($this);
        }

        return $this;
    }

    public function removeWorkPiece(WorkPiece $workPiece): static
    {
        if ($this->workPieces->removeElement($workPiece)) {
            $workPiece->removeCategory($this);
        }

        return $this;
    }
}

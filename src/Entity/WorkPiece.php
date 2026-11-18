<?php

namespace App\Entity;

use App\Repository\WorkPieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkPieceRepository::class)]
class WorkPiece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTime $release_date = null;

    #[ORM\ManyToOne(inversedBy: 'workPieces')]
    #[ORM\JoinTable(name: 'WorkType')]
    private ?WorkType $workType = null;

    /**
     * @var Collection<int, Copy>
     */
    #[ORM\OneToMany(targetEntity: Copy::class, mappedBy: 'idWorkPiece')]
    #[ORM\JoinTable(name: 'work_piece_category')]
    private Collection $copies;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'workPieces')]
    #[ORM\JoinTable(name: 'work_piece_author')]
    private Collection $category;

    /**
     * @var Collection<int, Author>
     */
    #[ORM\ManyToMany(targetEntity: Author::class)]
    private Collection $author;

    public function __construct()
    {
        $this->copies = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->author = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTime $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getWorkType(): ?WorkType
    {
        return $this->workType;
    }

    public function setWorkType(?WorkType $workType): static
    {
        $this->workType = $workType;

        return $this;
    }

    /**
     * @return Collection<int, Copy>
     */
    public function getCopies(): Collection
    {
        return $this->copies;
    }

    public function addCopy(Copy $copy): static
    {
        if (!$this->copies->contains($copy)) {
            $this->copies->add($copy);
            $copy->setIdWorkPiece($this);
        }

        return $this;
    }

    public function removeCopy(Copy $copy): static
    {
        if ($this->copies->removeElement($copy)) {
            // set the owning side to null (unless already changed)
            if ($copy->getIdWorkPiece() === $this) {
                $copy->setIdWorkPiece(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->author->contains($author)) {
            $this->author->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->author->removeElement($author);

        return $this;
    }
}

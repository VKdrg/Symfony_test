<?php

namespace App\Entity;

use App\Repository\CopyRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity(repositoryClass: CopyRepository::class)]
class Copy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $availability = null;

    #[ORM\Column(length: 50, nullable: false)]
    private ?string $inventoryCode = null;

    #[ORM\ManyToOne(inversedBy: 'copies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WorkPiece $idWorkPiece = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    public function getInventoryCode(): ?string
    {
        return $this->inventoryCode;
    }

    public function setInventoryCode(string $inventoryCode): static
    {
        $this->inventoryCode = $inventoryCode;

        return $this;
    }

    public function getIdWorkPiece(): ?WorkPiece
    {
        return $this->idWorkPiece;
    }

    public function setIdWorkPiece(?WorkPiece $idWorkPiece): static
    {
        $this->idWorkPiece = $idWorkPiece;

        return $this;
    }
}

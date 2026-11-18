<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $loanDate = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: false)]
    private ?\DateTimeImmutable $returnDateProgrammed = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $returnDateReal = null;

    #[ORM\ManyToOne]
    #[ORM\JoinTable(name: 'Copy')]
    private ?Copy $idCopy = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    private ?User $user = null;

    // Join_on_User

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoanDate(): ?\DateTime
    {
        return $this->loanDate;
    }

    public function setLoanDate(\DateTime $loanDate): static
    {
        $this->loanDate = $loanDate;

        return $this;
    }

    public function getReturnDateProgrammed(): ?\DateTimeImmutable
    {
        return $this->returnDateProgrammed;
    }

    public function setReturnDateProgrammed(\DateTimeImmutable $returnDateProgrammed): static
    {
        $this->returnDateProgrammed = $returnDateProgrammed;

        return $this;
    }

    public function getReturnDateReal(): ?\DateTimeImmutable
    {
        return $this->returnDateReal;
    }

    public function setReturnDateReal(\DateTimeImmutable $returnDateReal): static
    {
        $this->returnDateReal = $returnDateReal;

        return $this;
    }

    public function getIdCopy(): ?Copy
    {
        return $this->idCopy;
    }

    public function setIdCopy(?Copy $idCopy): static
    {
        $this->idCopy = $idCopy;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

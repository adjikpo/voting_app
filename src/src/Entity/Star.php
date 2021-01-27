<?php

namespace App\Entity;

use App\Repository\StarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StarRepository::class)
 */
class Star extends MappedSuperclassBase
{
    /**
     * @ORM\Column(type="integer")
     */
    private ?int $mark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $label;

    /**
     * @ORM\OneToMany(targetEntity=Vote::class, mappedBy="star", orphanRemoval=true)
     */
    private ArrayCollection $votes;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Vote[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setStar($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->votes->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getStar() === $this) {
                $vote->setStar(null);
            }
        }

        return $this;
    }
}

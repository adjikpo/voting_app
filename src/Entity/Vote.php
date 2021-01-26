<?php

namespace App\Entity;

use App\Repository\VoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoteRepository::class)
 */
class Vote extends MappedSuperclassBase
{
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=Star::class, inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Star $star;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Question $question;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStar(): ?Star
    {
        return $this->star;
    }

    public function setStar(?Star $star): self
    {
        $this->star = $star;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\QuestionsAnoncesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsAnoncesRepository::class)
 */
class QuestionsAnonces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Anonces::class, inversedBy="questionsAnonces")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $Anonces;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="question")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAnonces(): ?Anonces
    {
        return $this->Anonces;
    }

    public function setAnonces(?Anonces $Anonces): self
    {
        $this->Anonces = $Anonces;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

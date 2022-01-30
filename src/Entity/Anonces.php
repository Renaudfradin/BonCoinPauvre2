<?php

namespace App\Entity;

use App\Repository\AnoncesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnoncesRepository::class)
 */
class Anonces
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tags;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createPost;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UserCreate;

    /**
     * @ORM\OneToMany(targetEntity=QuestionsAnonces::class, mappedBy="Anonces")
     */
    private $questionsAnonces;

    public function __construct()
    {
        $this->questionsAnonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getCreatePost(): ?\DateTimeInterface
    {
        return $this->createPost;
    }

    public function setCreatePost(\DateTimeInterface $createPost): self
    {
        $this->createPost = $createPost;

        return $this;
    }

    public function getUserCreate(): ?string
    {
        return $this->UserCreate;
    }

    public function setUserCreate(string $UserCreate): self
    {
        $this->UserCreate = $UserCreate;

        return $this;
    }

    /**
     * @return Collection|QuestionsAnonces[]
     */
    public function getQuestionsAnonces(): Collection
    {
        return $this->questionsAnonces;
    }

    public function addQuestionsAnonce(QuestionsAnonces $questionsAnonce): self
    {
        if (!$this->questionsAnonces->contains($questionsAnonce)) {
            $this->questionsAnonces[] = $questionsAnonce;
            $questionsAnonce->setAnonces($this);
        }

        return $this;
    }

    public function removeQuestionsAnonce(QuestionsAnonces $questionsAnonce): self
    {
        if ($this->questionsAnonces->removeElement($questionsAnonce)) {
            // set the owning side to null (unless already changed)
            if ($questionsAnonce->getAnonces() === $this) {
                $questionsAnonce->setAnonces(null);
            }
        }

        return $this;
    }
}

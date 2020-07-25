<?php

namespace App\Entity;

use App\Repository\MicroPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MicroPostRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class MicroPost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="postsLiked")
     * @ORM\JoinTable(name="post_likes",
     *     joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $likedBy;

    public function __construct()
    {
        $this->likedBy = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime(): ?\DateTime
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime(?\DateTime $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @ORM\PrePersist()
    */
    public function setTimeonPersist(): void
    {
        $this->time = new \DateTime();
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * return Collection
     */
    public function getLikedBy()
    {
        return $this->likedBy;
    }

    public function like(User $user)
    {
        if ($this->likedBy->contains($user)) {
            return;
        }

        $this->likedBy->add($user);
    }


}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AppUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppUserRepository::class)]
#[ApiResource]
class AppUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\Column(type: 'string', length: 255)]
    private $app_password;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Article::class)]
    private $articles;

    #[ORM\OneToMany(mappedBy: 'app_user', targetEntity: AppLike::class)]
    private $likes;

    #[ORM\Column(type: 'datetime')]
    private $registered_at;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->app_likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getAppPassword(): ?string
    {
        return $this->app_password;
    }

    public function setAppPassword(string $password): self
    {
        $this->app_password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getAppLikes(): Collection
    {
        return $this->app_likes;
    }

    public function addAppLike(AppLike $like): self
    {
        if (!$this->app_likes->contains($like)) {
            $this->app_likes[] = $like;
            $like->setAppUser($this);
        }

        return $this;
    }

    public function removeAppLike(AppLike $like): self
    {
        if ($this->app_likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getAppUser() === $this) {
                $like->setAppUser(null);
            }
        }

        return $this;
    }

    public function getRegisteredAt(): ?\DateTimeInterface
    {
        return $this->registered_at;
    }

    public function setRegisteredAt(\DateTimeInterface $registered_at): self
    {
        $this->registered_at = $registered_at;

        return $this;
    }

    public function serialize() {
        $serialize = [
            "id" => $this->getId(),
            "username" => $this->getUsername(),
            'registered_at' => $this->getRegisteredAt()->format('Y-m-d H:i:s')
        ];  

        return $serialize;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AppLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppLikeRepository::class)]
#[ORM\Table(name: 'app_like')]
#[ApiResource]
class AppLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: AppUser::class, inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private $app_user;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private $article;

    #[ORM\Column(type: 'datetime')]
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppUser(): ?AppUser
    {
        return $this->app_user;
    }

    public function setAppUser(?AppUser $app_user): self
    {
        $this->app_user = $app_user;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function serialize()
    {
        $serialize = [
            'id' => $this->getId(),
            'user' => $this->getAppUser()->serialize(),
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s')
        ];

        return $serialize;
    }
}

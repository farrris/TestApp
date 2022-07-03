<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\ManyToOne(targetEntity: AppUser::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private $author;

    #[ORM\Column(type: 'datetime')]
    private $published_at;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: AppLike::class)]
    private $app_likes;

    public function __construct()
    {
        $this->app_likes = new ArrayCollection();
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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): ?AppUser
    {
        return $this->author;
    }

    public function setAuthor(?AppUser $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeInterface $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->app_likes;
    }

    public function addLike(AppLike $like): self
    {
        if (!$this->app_likes->contains($like)) {
            $this->app_likes[] = $like;
            $like->setArticle($this);
        }

        return $this;
    }

    public function removeLike(AppLike $like): self
    {
        if ($this->app_likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getArticle() === $this) {
                $like->setArticle(null);
            }
        }

        return $this;
    }

    public function serialize() {
        $serialize = [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'category' => $this->getCategory()->serialize(),
            'author' => $this->getAuthor()->serialize(),
            'published_at' => $this->getPublishedAt()->format('Y-m-d H:i:s')
        ];

        return $serialize;
    }
}

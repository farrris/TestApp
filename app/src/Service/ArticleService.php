<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\AppUserRepository;

class ArticleService
{
  public function __construct(private ArticleRepository $articleRepository,
                              private CategoryRepository $categoryRepository,
                              private AppUserRepository $appUserRepository) {}

  public function index(Request $request): Array {
    
    $page = $request->query->get('page', 1);
    $limit = $request->query->get('limit', 10);
    $category = $request->query->get('category', null);

    if ($category != null) {
      $category = $this->categoryRepository->findBy(['title' => $category]);
      $articles = $this->articleRepository->findBy(['category' => $category]);
    }

    else {
      $articles = $this->articleRepository->findAll();
    }

    $data = [];

    $counter = 1;
    foreach ($articles as $article) {
      if ($counter > ($page*$limit-$limit) && $counter <= $page*$limit)
        $data[] = $article->serialize();
        
      $counter++;
    }

    return $data;
  }

  public function create(Request $request): Array
  {
    $json_data = json_decode($request->getContent(), true);

    if (
      empty($json_data["title"]) ||
      empty ($json_data["category"]) ||
      empty($json_data["author"])
    ) {
      return ["message" => "Ожидалось больше параметров"];
    }

    $title = $json_data["title"];

    if ($this->articleRepository->findOneBy(["title" => $title]) != null)
      return ["message" => "Статья с таким названием уже существует"];

    $category_title = $json_data["category"];
    $author_username = $json_data["author"];
    $date = new \DateTime(null, new \DateTimeZone('Europe/Moscow'));

    $category = $this->categoryRepository->findOneBy(["title" => $category_title]);

    if (!$category)
      return ["message" => "Категория не найдена"];

    $author = $this->appUserRepository->findOneBy(["username" => $author_username]);

    if (!$author)
      return ["message" => "Пользователь не найден"];

    $article = new Article();
    $article->setTitle($title);
    $article->setCategory($category);
    $article->setAuthor($author);
    $article->setPublishedAt($date);

    $this->articleRepository->add($article, true);

    return ["message" => "Статья опубликована"]; 
  }
}
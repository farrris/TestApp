<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService 
{
  public function __construct(private CategoryRepository $categoryRepository) {}

  public function getAll() 
  {
    $categories = $this->categoryRepository->findAll();

    $data = [];

    foreach ($categories as $category) {
      $data[] = $category->serialize();
    }

    return $data;
  }

  public function create(Request $request)
  {
    $json_data = json_decode($request->getContent(), true);
    
    if (empty($json_data["title"]))
      return ["message" => "Ожидалось больше параметров"];
    
    $title = $json_data["title"];
    $date = new \DateTime(null, new \DateTimeZone('Europe/Moscow'));
    if ($this->categoryRepository->findOneBy(["title" => $title]) != null)
      return ["message" => "Категория с таким названием уже существует"];

    $category = new Category();
    $category->setTitle($title);
    $category->setCreatedAt($date);

    $this->categoryRepository->add($category, true);

    return ["message" => "Категория создана"];
  }
}

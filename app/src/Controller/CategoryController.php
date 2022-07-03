<?php

namespace App\Controller;

use App\Service\CategoryService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends AbstractController
{
  public function __construct(private CategoryService $categoryService) {}

  public function index(): JsonResponse
  {   
      $data = $this->categoryService->getAll();
      $response = new JsonResponse($data, Response::HTTP_OK);
      $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
      return $response;
  }

  public function create(Request $request): JsonResponse
  {   
      
      $data = $this->categoryService->create($request);
      $response = new JsonResponse($data, Response::HTTP_OK);
      $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
      return $response;
      
  }
}

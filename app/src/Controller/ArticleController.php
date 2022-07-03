<?php

namespace App\Controller;

use App\Service\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{
    public function __construct(private ArticleService $articleService) {}

    public function index(Request $request): JsonResponse
    {   
        $data = $this->articleService->index($request);
        $response = new JsonResponse($data, Response::HTTP_OK);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }

    public function create(Request $request): JsonResponse
    {   
        $data = $this->articleService->create($request);
        $response = new JsonResponse($data, Response::HTTP_OK);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }
}

<?php

namespace App\Controller;

use App\Service\LikeService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LikeController extends AbstractController
{
    public function __construct(private LikeService $likeService) {}

    public function index($id)
    {
        $data = $this->likeService->index($id);
        $response = new JsonResponse($data, Response::HTTP_OK);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }

    public function like(Request $request, $id)
    {
        $data = $this->likeService->like($request, $id);
        $response = new JsonResponse($data, Response::HTTP_OK);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }
}

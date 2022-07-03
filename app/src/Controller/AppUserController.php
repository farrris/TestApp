<?php

namespace App\Controller;

use App\Service\AppUserService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppUserController extends AbstractController
{
    public function __construct(private AppUserService $appUserService) {}

    public function register(Request $request): JsonResponse
    {
        $data = $this->appUserService->register($request);
        $response = new JsonResponse($data, Response::HTTP_OK);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        return $response;
    }
}

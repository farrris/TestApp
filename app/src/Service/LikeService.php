<?php

namespace App\Service;

use App\Repository\AppUserRepository;
use App\Repository\ArticleRepository;
use App\Repository\AppLikeRepository;

use App\Entity\AppLike;

use Symfony\Component\HttpFoundation\Request;

class LikeService 
{
  public function __construct(private AppUserRepository $appUserRepository,
                              private ArticleRepository $articleRepository,
                              private AppLikeRepository $appLikeRepository) {}

  public function index($id)
  {
    $article = $this->articleRepository->findOneBy(["id" => $id]);
    $likes = $article->getLikes();
    
    $data = [];
    
    foreach($likes as $like) 
    {
      $data[] = $like->serialize(); 
    };

    return $data;
  }

  public function like(Request $request, $id)
  {
    $json_data = json_decode($request->getContent(), true);

    if (empty($json_data["username"]) || empty($json_data["password"]))
      return ["message" => "Ожидалось больше параметров"];

    $username = $json_data["username"];
    $password = $json_data["password"];

    $user = $this->appUserRepository->findOneBy(['username' => $username]);
    $user_password = $user->getAppPassword();
    $checked_password = password_verify($password, $user_password);

    if (!$user || $checked_password == false)
      return ["message" => "Unauthorized"];

    $article = $this->articleRepository->findOneBy(['id' => $id]);

    $date = new \DateTime(null, new \DateTimeZone('Europe/Moscow'));

    if ($this->appLikeRepository->findOneBy(["app_user" => $user->getId(), "article" => $article->getId()]))
    {  
      $like = $this->appLikeRepository->findOneBy(["app_user" => $user->getId(), "article" => $article->getId()]);
      $this->appLikeRepository->remove($like, true);
      return ["message" => "Лайк убран"];
    } 
    else
    {
      $like = new AppLike();
      $like->setAppUser($user);
      $like->setArticle($article);
      $like->setCreatedAt($date);

      $this->appLikeRepository->add($like, true);
      return ["message" => "Лайк поставлен"];
    } 
  }
}
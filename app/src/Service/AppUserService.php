<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\AppUser;
use App\Repository\AppUserRepository;

class AppUserService 
{

  public function __construct(private AppUserRepository $appUserRepository) {}

  public function register(Request $request): Array 
  {
    $json_data = json_decode($request->getContent(), true);

    if (empty($json_data["username"]) || empty($json_data["password"]))
      return ["message" => "Ожидалось больше параметров"];

    $username = $json_data["username"];
    $password = $json_data["password"];

    $date = new \DateTime(null, new \DateTimeZone('Europe/Moscow'));

    if ($this->appUserRepository->findOneBy(["username" => $username]) != null)
      return ["message" => "Пользователь с таким именем уже существует"];

    $user = new AppUser();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user->setUsername($username);
    $user->setAppPassword($hashed_password);
    $user->setRegisteredAt($date);

    $this->appUserRepository->add($user, true);

    return ["message" => "Пользователь успешно создан"];
  }

}
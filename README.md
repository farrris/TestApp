# Тестовое задание (PITCH) 

## Технологии:
1. PHP 8
2. Symfony 6
3. PostgreSql 13
4. Docker

## Запуск проекта:
1. docker-compose up
2. docker exec testapp-php-cli composer install

Проект запустится на https://localhost:8080

## API:

### `POST: /api/auth/register` - Регистрация пользователя  
Необходимо предоставить JSON со следующими данными:
>"username": string  
>"password": string  
### `GET: /api/category` - вывод списка всех категорий
### `POST: /api/category` - создание категории
Необходимо предоставить JSON со следующими данными:
>"title": string   
### `GET: /api/article` - вывод списка всех новостей
### `POST: /api/article` - создание новости
Необходимо предоставить JSON со следующими данными:
>"title": string  
>"author": string (username пользователя)  
>"category": string (title категории)    
### `GET: /api/article/{id}/like` - выводит список лайков по указанному id статьи
### `POST: /api/article/{id}/like` - устанавливает лайк на конкретную статью конкретным пользователем. 
Данные пользователя получаем из тела запроса:
>"username": string  
>"password": string  

Используется для подтверждения доступа пользователем

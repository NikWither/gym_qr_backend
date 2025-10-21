# Развертывание REST API проекта

Этот проект — Laravel REST API, упакованный в Docker. Ниже пошаговая инструкция, как поднять сервис с нуля после `git clone`.

## Требования
- Docker и Docker Compose v2
- Make (опционально) — все команды можно вызвать через `docker compose`

## Первоначальная настройка
1. Склонируйте репозиторий и перейдите в каталог проекта:  
   ```bash
   git clone <repo-url>
   cd backend
   ```
2. Скопируйте `.env.example` в `.env`:  
   ```bash
   cp .env.example .env
   ```
3. Обновите ключевые переменные в `.env`:
   ```dotenv
   APP_NAME="Business Gym API"
   APP_URL=http://localhost:8000

   # База данных внутри Docker Compose
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel        # либо измените имя в docker-compose.yml
   DB_USERNAME=laravel        # то же значение, что и в docker-compose.yml
   DB_PASSWORD=secret         # то же значение, что и в docker-compose.yml

   # API работает без серверных сессий
   SESSION_DRIVER=array
   ```

## Сборка и запуск контейнеров
```bash
docker compose up --build -d
```

После сборки будут доступны три сервиса:
- `app` — PHP-FPM с кодом Laravel (`http://app:9000` внутри сети Docker)
- `web` — Nginx, проксирует запросы на PHP (`http://localhost:8000`)
- `mysql` — база данных MySQL 8.0 (`localhost:3306`, логины из `.env`)

## Подготовка приложения
Выполните команды внутри контейнера `app`:
```bash
docker compose exec app bash

# внутри контейнера
composer install
php artisan key:generate
php artisan migrate            # создаёт таблицы, включая Sanctum
php artisan db:seed            # опционально: заполняет тестовыми данными
exit
```

Если пароли пользователей создаются через сидеры — убедитесь, что они хешируются (`Hash::make`).

## Проверка API
- Логин: `POST http://localhost:8000/api/login`  
  ```json
  {
    "email": "admin@example.com",
    "password": "admin"
  }
  ```
  В ответ получите токен Sanctum.
- Выход: `POST http://localhost:8000/api/logout` c заголовком `Authorization: Bearer <token>`.
- Защищённые роуты добавляются внутри `routes/api.php` в группу `middleware('auth:sanctum')`.

## Полезные команды
- Просмотр логов приложения:  
  ```bash
  docker compose logs app
  docker compose exec app tail -f storage/logs/laravel.log
  ```
- Перезапуск сервисов:  
  ```bash
  docker compose restart
  ```
- Остановка и удаление контейнеров:  
  ```bash
  docker compose down
  ```

## Частые проблемы
- **500 / таймаут при логине** — проверьте, что миграции Sanctum выполнены и сессии отключены (`SESSION_DRIVER=array`).
- **Нет подключения к БД** — в `.env` должен быть `DB_HOST=mysql`, а контейнер `mysql` запущен (`docker compose ps`).
- **Не видит зависимости** — контейнер `app` создаётся без vendor. Всегда запускайте `composer install` внутри контейнера после сборки.

Теперь API готов к работе по адресу `http://localhost:8000`. Используйте токены Sanctum в заголовке `Authorization` для обращения к защищённым маршрутам.

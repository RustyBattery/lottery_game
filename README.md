# sputnik_back

из каталога /deploy запустить:
- docker-compose up -d
- docker exec -it app bash
- composer install

скопировать файл /project/.env.example в /project/.env и настроить по необходимости 

выполнить следующие команды:
- php artisan key:generate
- php artisan migrate
- php artisan db:seed (если нужно)
- php artisan jwt:secret

для работы очереди:
- docker exec -it app_queue bash
- php artisan queue:work
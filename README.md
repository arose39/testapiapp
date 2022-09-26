Для запуска проекту:
 - 1. Спочатку встановіть залежності
 - composer install
 - npm i
 - 2. Потім перейменуте .env.example у .env
 - 3 Запустіть докер та виконайте команду bash ./vendor/bin/sail up
 - створіть аліас alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

   Для выполнения миграций и наполнений таблиц пропишите комануду
 - sail artisan migrate --seed

В Базі вже буде користувач з правами адміну:
 - admin@admin.com
 - password

Однак ви можете самостійно надати права адміну будь-якому користувачу:
- sail artisan assign:admin <youruseremail@email.com>

Також для зручності є окремий (не випадково сгенерований) користувач:
- test@test.com
- password

Для тестування апі:
 - GET 127.0.0.1/sanctum/csrf-cookie для отримання XSRF cookie
 - POST 127.0.0.1/ua/login  - додайте заголовок X-XSRF-TOKEN і зкопіюйте токен з XSRF cookie
 
  Після цього можна виконати  :
 - у всіх запитах повинне бути вказаний заголовки Referer 127.0.0.1 та Accept application/json
    - GET 127.0.0.1/api/v1/ua/products/
    - GET 127.0.0.1/api/v1/en/products/
    - GET 127.0.0.1/api/v1/en/products/9
    - GET 127.0.0.1/api/v1/ua/products/9
    - GET http://127.0.0.1/api/v1/ua/products/9/makeorder

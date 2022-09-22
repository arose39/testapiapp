bash ./vendor/bin/sail up
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail artisan migrate:refresh
migrate:refresh

Для предоставления прав администратора использовать команду
- sail artisan assign:admin <youruseremail@email.com>
- sail artisan db:seed

Для выполнения миграций и наполнений таблиц пропишите комануду
- sail artisan migrate --seed

admin@admin.com password

bash ./vendor/bin/sail up
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail artisan migrate
migrate:refresh

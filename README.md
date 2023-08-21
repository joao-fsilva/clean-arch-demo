
# Clean Arch Demo

This project demonstrates the use of Clean Architecture.

## Layers

The core of the system is in the "Demo" directory. In the infrastructure layer Lumen is used. Layer list

1. Domain
2. Application
3. Infra (Lumen)

Install

```
 cp .env.example .env

 cd /www/clean-arch-demo-back-end/docker/dev/
 
 docker-compose up -d
 
 docker exec -it cademo-dev-php bash
 
 composer install
 
 php artisan migrate

```

    

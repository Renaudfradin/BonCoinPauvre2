## Boncoipauvre

composer install
docker-compose up -d
symfony console make:migration
symfony console doctrine:migration:migrate
symfony console doctrine:fixtures:load  yes


README.
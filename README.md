# Instalación
```shell
git clone git@github.com:e-aleixandre/prueba-sesame.git
cd prueba-sesame
docker-compose up -d --build
docker exec -it php74-container composer install
docker exec -it php74-container php bin/console doctrine:database:create
docker exec -it php74-container php bin/console doctrine:migrations:migrate
# Extra: Seed the database
docker exec -it php74-container php bin/console doctrine:fixtures:load
```
# Instalación
```shell
git clone git@github.com:e-aleixandre/prueba-sesame.git
cd prueba-sesame
docker-compose up -d --build
docker exec -it php74-container composer install
docker exec -it php74-container php bin/console doctrine:database:create
```
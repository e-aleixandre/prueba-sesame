# Instalación
```shell
git clone git@github.com:e-aleixandre/prueba-sesame.git
cd prueba-sesame
docker-compose up -d --build
docker exec -it php74-container composer install
docker exec -it php74-container php bin/console doctrine:database:create
docker exec -it php74-container php bin/console doctrine:migrations:migrate
# Extra: Llenar la base de datos con información de prueba
docker exec -it php74-container php bin/console doctrine:fixtures:load
```

Una vez ejecutados los comandos la API estará disponible en ``http://localhost:8080/``

# Endpoints
Para interactuar con la API se han diseñado los siguientes endpoints:

### User
```
GET /users
GET /users/{id}
POST /users
PUT /users/{id}
DELETE /users/{id}
GET /users/{id}/workentries
```

### WorkEntry
```
POST /workentry
PUT /workentry/{id}
DELETE /workentry/{id}
GET /workentry/{id}
```
# manosos-laravel
# basado en https://hub.docker.com/r/bitnami/laravel/ 

# Pasos para levantar:

0. Levantar usando docker

Pre-requisitos:

Composer version >=2.5.8
Docker version >=24.0.4

# 1. una vez clonado el repositorio se debe levantar los contenedores de docker para el servidor web y la bd con:

sudo docker-compose up

# 2. una vez levantado los contenedores ingresar al contenedor de db:

sudo docker exec -it manosos-app_mariadb_1 bash

# 3. al estar dentro del contenedor de db se debe ingresar al cli de mysql:

$ mysql -u root
$ use app_manosos_db;

# 4. restaurar copiando y pegando el dump que está en manosos-app/dev/sql/manosos.sql

# 5. ingresar a la siguiente ruta: 

http://0.0.0.0:8000/login
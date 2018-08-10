# php-app-with-slim-and-docker
PHP Application with SLIMPHP web framework using Docker connecting to third-party API

```bash
docker pull php:latest
docker pull php:5.6
# run the hello.php (optional)
docker run --rm -v $(pwd):/app php:latest php /app/hello.php
# install the slim library
docker run --rm -v $(pwd):/app composer:latest require slim/slim "^3.0"
# run the app
docker run --rm -p 38000:80 -v $(pwd):/var/www/html php:apache
# or run the app in detached mode
docker run -d --rm -p 38000:80 -v $(pwd):/var/www/html php:apache
# name the container
docker run -d --rm --name=weather-app -p 38000:80 -v $(pwd):/var/www/html php:apache
# display running containers
docker ps
# or display all containers including the stopped containers
docker ps -a
# stop the container with id of three characters or more
docker stop <ID>
# stop the container (alternative)
docker stop <container-name>
# run the docker container again
docker run -d --rm --name=weather-app -p 38000:80 -v $(pwd):/var/www/html php:apache
# run the database container and named it as weather_db from image mysql with version  5.7
docker run -d --rm --name=weather_db -e MYSQL_USER=kenvilar -e MYSQL_DATABASE=weather_app -e MYSQL_PASSWORD=kenvilarsamplepassord -e MYSQL_RANDOM_ROOT_PASSWORD=true mysql:5.7
```

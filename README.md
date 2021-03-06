# php-app-with-slim-and-docker
PHP Application with SLIMPHP web framework using Docker connecting to third-party API   
Login credentials below are just an example


## Build the image and tagged it as kenvilar/weather-app to easily create a container from this image
```docker
docker build . -t kenvilar/weather-app
```


```docker
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
docker run -d --rm --name=weather_app -p 38000:80 -v $(pwd):/var/www/html php:apache
# display running containers
docker ps       
# or display all containers including the stopped containers
docker ps -a        
# stop the container with id of three characters or more
docker stop <ID>        
# stop the container (alternative)
docker stop <container-name>    
```

```docker
# run the docker container again 
docker run -d --rm --name=weather_app -p 38000:80 -v $(pwd):/var/www/html php:apache
# run the database container and named it as weather_db from image mysql with version  5.7
docker run -d --rm --name=weather_db -e MYSQL_USER=kenvilar -e MYSQL_DATABASE=weather_app -e MYSQL_PASSWORD=kenvilarsamplepassword -e MYSQL_RANDOM_ROOT_PASSWORD=true mysql:5.7
# check if the database weather_app is running
# first access the container bash with named weather_db
docker exec -it weather_db bash
# first access the container bash with named weather_db (alternative)
docker exec -it weather_db sh
# access the mysql db and input your password and see if there is name weather_app
mysql -u kenvilar -p
mysql> show databases;
# and then exit and stop the weather_db container
mysql> \q
docker stop weather_db
# to start mysql container with the database saved to our host system, this will create .data folder
docker run -d --rm --name=weather_db -e MYSQL_USER=kenvilar -e MYSQL_DATABASE=weather_app -e MYSQL_PASSWORD=kenvilarsamplepassword -e MYSQL_RANDOM_ROOT_PASSWORD=true -v $(pwd)/.data:/var/lib/mysql mysql:5.7
```

# Create DB table
```docker
docker exec -it weather_db bash
root@<id>: mysql -u kenvilar -p
mysql> use weather_app
mysql> create table locations (id varchar(64) not null, weather json null, last_updated timestamp default current_timestamp);
mysql> show tables;
```

# Linking the PHP container
```docker
docker run -d --rm --name=weather_app -p 38000:80 -v $(pwd):/var/www/html --link weather_db kenvilar/weather-app
# if it gets an error then you have to remove the container named weather_app
```

# Stop the container and re-run it with the environment variables
```docker
docker run -d --rm --name=weather_app -p 38000:80 -v $(pwd):/var/www/html --link weather_db -e DATABASE_HOST='weather_db' -e DATABASE_USER='kenvilar' -e DATABASE_PASSWORD='kenvilarsamplepassword' -e DATABASE_NAME='weather_app' kenvilar/weather-app
```

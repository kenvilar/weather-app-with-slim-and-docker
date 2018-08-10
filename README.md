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
```

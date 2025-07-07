#### docker/nginx/conf.d/smriti.conf::

# Differnces:::

Previously, I've have mentioned access_log and error_log. Without logging, you won't get useful debug info in case of errors like 502, 404, etc.
So, I included logs here for proper debugging.

In similar case, I have included the timeout and buffer setting:

#### php-fpm.conf::

# Differences:::

Version 1(dockerfixed) works standalone.[

## Everything is inside one file.

## You don’t need any extra config files.

## PHP-FPM works as long as this file exists and is valid.

## Simple and works easily in Docker.]

Version 2(docker) needs external config (like www.conf) — if that file is missing or wrong, PHP-FPM breaks.

daemonize :[yes means outside Docker container (traditional hosting)
no means inside Docker container (like in your Laravel Docker setup)]
listen:9000 ( Same container (PHP + Nginx setup))
listen:0.0.0.0.9000 ( Multi-container Docker (Nginx + PHP-FPM separate))

#### entrypoint.sh

# version 1::📦 Install composer dependencies only if vendor folder doesn't exist,

            :: Skips key:generate if already set
            ::Has set -e (fails early if something breaks)

# version 2::📦 Always installs composer dependencies

            ::Always skips checking it
            ::No set -e (may continue after errors)

(version 2)php-fpm:Shell is still running; Docker can get confused when stopping or restarting things ❌
(version 1)exec php-fpm ✅:Shell is gone, only PHP runs — Docker can stop it or restart it properly ✔✔✔

#### docker-compose.yml::

Previously, I haven't provided the bridge for the networks connection for the php-fpm and nginx.But, later, I have given networks: laravel:driver: bridge

#### Dockerfile::

## First Dockerfile

Installs all needed software (like PHP extensions, npm, netcat) when building the image.

Copies your Laravel app code into the image at build time.

Runs composer install during build, so dependencies are ready when the container starts.

Sets folder permissions inside the image to avoid errors.

Automatically starts PHP-FPM when the container runs.

Good for: Fast, reliable startup and production use.

## Second Dockerfile

Installs fewer packages during build (no netcat or npm).

Does NOT copy your app code or run composer install during build.

Expects setup like installing dependencies and permissions to happen when the container starts (in the entrypoint script).

You need to manage starting PHP-FPM yourself in the entrypoint script.

## Solved :

-Confirm PHP-FPM listens on port 9000 on all interfaces (listen = 0.0.0.0:9000 in php-fpm config).

-Make sure both Nginx and PHP services are in the same Docker network.\

######

## For my personal understandings...

{{{[[

## fastcgi_read_timeout 300;

Nginx will wait up to 300 seconds (5 minutes) for a response from the PHP-FPM (FastCGI) backend.

## fastcgi_send_timeout 300;

Maximum time Nginx waits while sending data to FastCGI (PHP-FPM).

## fastcgi_buffers 16 16k;

Handles output from PHP (like large JSON responses or HTML pages) without choking.

## fastcgi_buffer_size 32k;

Size of the initial buffer used for the first part of the FastCGI response (like headers).

(In Docker, nginx/conf.d/smriti.conf is mounted into your Nginx container to:

Serve your Laravel app

Communicate with your PHP container (usually called app)

Handle routing and request forwarding

Act as the frontend web server for your entire project)

### php-fpm.conf

Controls PHP worker processes and logging.
Works with Nginx in Docker by listening on port 9000.
Helps optimize PHP performance and debugging in Dockerized Laravel apps.
PHP-FPM runs PHP code when your web server (like Nginx) asks for it.
]]}}}

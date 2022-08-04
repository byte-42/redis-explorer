# redis-explorer

A lightweight redis explorer to quickly search through keys.

### Usage
```
docker
```

### Develop
```bash
# install deps
composer install

# run server
php -S 127.0.0.1:8000 -t public

# view aplication
open http://localhost:8000
```

### Publish Docker Image
```bash
# build image
docker build . -t redis-explorer:latest

# publish image
docker image tag redis-explorer:latest byte42/redis-explorer:latest
docker image push byte42/redis-explorer:latest

```

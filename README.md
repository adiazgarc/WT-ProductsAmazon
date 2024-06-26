# Prueba Amazon

Procesar un JSON y crear una landing sencilla basada en los datos del archivo.

El JSON que Amazon genera para un listado de productos contiene toda la información relevante a un listado de productos (URL, imagen, precio, descripción, etc.)


## Authors

- [@adiazgarc](https://github.com/adiazgarc)


## Deployment

1 - Clonamos el proyecto

```bash
  git clone https://github.com/adiazgarc/WT-ProductsAmazon.git
```

2 - Creamos los contenedores

**Primera vez**
```bash
  docker-compose up -d --build
```

**Siguientes ejecuciones (no es necesario build)**
```bash
  docker-compose up -d
```

3 - Actualizar dependencias y permisos

**Acceder al contenedor**
```bash
  docker exec -it wt-productsamazon_php_1 bash
```

**Permisos (solo linux)**
```bash
  chown -R www-data:www-data /var/www/html
```
```bash
  chmod -R 777 /var/www/html/var
```

**Actualizar dependecias **
```bash
  composer update
```

4 - Levantar CRON actualizar productos (ejecucion todos los dias a las 00)php bin/
```bash
  console messenger:consume
```

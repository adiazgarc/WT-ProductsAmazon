# Prueba Amazon

Procesar un JSON y crear una landing sencilla basada en los datos del archivo.

El JSON que Amazon genera para un listado de productos contiene toda la información relevante a un listado de productos (URL, imagen, precio, descripción, etc.)


## Autores

- [@adiazgarc](https://github.com/adiazgarc)


## Entorno

Configuración local puerto 80 

http://localhost/

Usuario pruebas DEMO:

Email: abc@abc.com

Password: 123

## Deployment y instalación (Primera vez)

1 - Clonamos el proyecto

```bash
  git clone https://github.com/adiazgarc/WT-ProductsAmazon.git
```

2 - Creamos el contenedor

**Crear contenedor**
```bash
  docker-compose up -d --build
```

3 - Actualizar dependencias y permisos

**Acceder al contenedor (Mac)**
```bash
  docker exec -it wt-productsamazon-php-1 bash
```
**Acceder al contenedor Linux)**
```bash
  docker exec -it wt-productsamazon_php_1 bash
```

**Actualizar dependecias (Dentro del contenedor)**
```bash
  composer update
```
**Actualizar dependecias Webpack (Dentro del contenedor)**
```bash
   npm install --global yarn
```
```bash
  yarn install
```
```bash
  yarn encore dev
```

**Permisos (Dentro del contenedor)**
```bash
  chown -R www-data:www-data /var/www/html
```

**Permisos (solo linux, dentro del contenedor)**
```bash
  chmod -R 777 /var/www/html/var
```

4 - Levantar CRON actualizar productos (ejecucion todos los dias a las 00)php bin/ (Dentro del contenedor)
```bash
  php bin/console messenger:consume
```

5 - Acceder desde navegador a http://localhost/


## Deployment (Ya realizada instalación )

1 - Levantamos el contenedores

**Levantar contenedor**
```bash
  docker-compose up -d
```
2 - Acceder desde navegador a http://localhost/
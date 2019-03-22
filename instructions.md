# Instrucciones

## Creando y configurando un nuevo proyecto de Laravel ✒️

**Crear nuevo proyecto**
```
$ composer create-project laravel/laravel auth "5.7.*"
```
**Crear la base de datos en Mysql**
```PowerShell
$ mysql -uroot -p
Enter password: 
 
MariaDB [(none)]> CREATE DATABASE auth;
```

**Configurar el entorno en el archivo `.env`**

```html
APP_NAME="Laravel Auth"
 
APP_URL=http://www.auth.local
 
DB_DATABASE=auth
DB_USERNAME=root
DB_PASSWORD=
 
MAIL_DRIVER=log
```









## Autores 

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Camilo Rodríguez Zelada**  - [CamiloARZ](https://github.com/CamiloARZ)


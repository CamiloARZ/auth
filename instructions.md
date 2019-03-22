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

```env
APP_NAME="Laravel Auth"
 
DB_DATABASE=auth
DB_USERNAME=root
DB_PASSWORD=
 
MAIL_DRIVER=log
```

```
Uso el driver de correo en MAIL_DRIVERcomolog. Para que cada vez que envio un correo dentro del sistema 
este se va a guardar dentro del archivo de log.
```
## Generando los módulos de registro y autenticación

##Index Lengths & MySQL / MariaDB""

```php
use Illuminate\Support\Facades\Schema;


public function boot()
{
    Schema::defaultStringLength(191);
}
```

**Ejecutar las migraciones de Laravel**
```
$ php artisan migrate
```

**Instalar el sistema de autenticación de Laravel**
```
$ php artisan make:auth
```
**Instalar Laravel-lang**
_Traducir los textos y mensajes al idioma español._
```
$ composer require caouecs/laravel-lang:~3.0
```
_Una vez finalizada la descarga, nos dirigimos al editor para copiar las carpetas de los idiomas que queramos, 
en el directorio `resources/lang`_

_Cambiar la configuración del idioma en `config/app.php`_
```php
'locale' => 'es'
```
















## Autores 

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Camilo Rodríguez Zelada**  - [CamiloARZ](https://github.com/CamiloARZ)


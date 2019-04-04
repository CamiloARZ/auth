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

**Index Lengths & MySQL / MariaDB**

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

##Generando módulo de verificación de usuario

**Agregar campos a la migración de usuarios**
__Lo primero es añadir un campo a la tabla de usuarios. Este campo lo llamaremos `confirmed` y nos 
permitirá saber si un usuario ya ha verificado si email o aun no. Además usaremos un segundo campo 
llamado `confirmation_code`._

```php
public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            ...
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            ...
        });
    }
```

**Modificando el método `create`de `RegisterController`**

_Si usamos el sistema de autenticación que Laravel genera, debes modificar el método create de `RegisterController`,
ubicado en `app\Http\Controllers\Auth`._

```php
protected function create(array $data)
{
    $data['confirmation_code'] = str_random(25);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'confirmation_code' => $data['confirmation_code']
    ]);

    // Send confirmation code
    Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
    });

    return $user;
}
```

_Añadimos el modelo `Mail` al controlador `RegisterController`_

```php
use Mail;
```

_Definiendo en la propiedad `fillable` de tu modelo User con los campos `username`, `email`, `password` y `confirmation_code`._

**Plantilla del email de confirmación**

_En el código anterior, el método `send` recibe como primer parámetro el template que se usará para el mail de confirmación._

_El valor de `emails.confirmation_code` significa que dentro de `resources/views` debemos tener una carpeta `emails`, que contenga un archivo `confirmation_code.blade.php` representando el mail que vamos a enviar._

```html
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Hola {{ $name }}, gracias por registrarte en <strong>Programación y más</strong> !</h2>
    <p>Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

    <a href="{{ url('/register/verify/' . $confirmation_code) }}">
        Clic para confirmar tu email
    </a>
</body>
</html>
```

**Controlador y ruta de verificación**

_Generar enlace de verificación que es enviado por mail, primero tenemos que definir nuestra ruta en `web.php`_

```php
Route::get('/register/verify/{code}', 'GuestController@verify');
```

_Creamos el controlador `GuestController`_

```
$ php artisan make:controller GuestController
```
_Añadimos el modelo `User` al controlador `GuestController`_

```php
use App\User;
```

_Diseñamos la fncion `verify`, que sera la encargada de confirmar la verificación_

```php
public function verify($code)
{
    $user = User::where('confirmation_code', $code)->first();

    if (! $user)
        return redirect('/');

    $user->confirmed = true;
    $user->confirmation_code = null;
    $user->save();

    return redirect('/home')->with('notification', 'Has confirmado correctamente tu correo!');
}

```

<!-- // -->

## Autores 

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **Camilo Rodríguez Zelada**  - [CamiloARZ](https://github.com/CamiloARZ)


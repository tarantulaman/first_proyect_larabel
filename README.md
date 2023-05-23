**INFORMACION DEL PROYECTO**

* Nombre completo del proyecto: *Primer Proyecto Web con Larabel*
* Número de proyecto: *1*
* Framework usado: *Larabel*
* Version de MariaDB: *10.6.11*

---

#### TABLA DE CONTENIDOS:
---

- [IMPORTANTE](#IMPORTANTE)
- [COMANDOS USADOS](#COMANDOS-USADOS)
- [EXTENSIONES VISUAL STUDIO](#EXTENSIONES-VISUAL-STUDIO)
- [INFORMACION DE ARCHIVOS Y CARPETAS DE UN PROYECTO EN LARABEL](#INFORMACION-DE-ARCHIVOS-Y-CARPETAS-DE-UN-PROYECTO-EN-LARABEL)
- [HABILITAR LARABEL EN LINUX CON APACHE2](#HABILITAR-LARABEL-EN-LINUX-CON-APACHE2)
- [COMANDOS PARA EJECUTAR UN PROYECTO DESCARGADO DE GITHUB](#COMANDOS-PARA-EJECUTAR-UN-PROYECTO-DESCARGADO-DE-GITHUB)

---

#### IMPORTANTE

1. Antes de comenzara a construir un proyecto en Laravel debemos tener
   instalado lo siguiente, dependiendo del sistema operativo

	 - Apache 2.0
	 - PHP 8
	 - Composer
	 - Node
	 - Maria DB

2. Si deseamos ver como crear un proyecto en Laravel, lo podemos hacer
   visitando la siguiente pagina

https://laravel.com/docs/9.x#your-first-laravel-project



3. Si deseamos crear un proyecto con una versin especifica de Larabel 
   lo podemos hacer de la siguiente manera

   **8.*** = *esto lo reemplazamos con la version que necesitemos en el comando
	     de arriba, si deseamos obtener la ultima version simplemente ejecutamos*
	    	      		      
```
composer create-project laravel/laravel:8.* project_name
```

```
laravel/laravel:8.*
laravel/laravel:7.*
laravel/laravel:6.*
laravel/laravel:5.*
```

   * *Si deseamos obtener la ultima version simplemente ejecutamos*

```
composer create-project laravel/laravel project_name
```

4. En sistemas operativos GNU-Linux/Ubuntu, debemos instalar los siguientes
   paquetes, para evitar el siguiente error

```
sudo apt-get install php8.0-curl
```

```
 Problem 1
    - spatie/laravel-ignition[1.0.0, ..., 1.6.4] require ext-curl * -> it is missing from your system. Install or enable PHP's curl extension.
    - Root composer.json requires spatie/laravel-ignition ^1.0 -> satisfiable by spatie/laravel-ignition[1.0.0, ..., 1.6.4].
```


5. Si deseamos los tipos de datos que podemos crear en "migrations", lo podemos hacer 
   visitando la siguiente pagina

https://laravel.com/docs/9.x/migrations#available-column-types


6. En sistemas operativos GNU-Linux/Ubuntu, debemos seguir los pasos de 
   [HABILITAR LARABEL EN LINUX CON APACHE2](#HABILITAR-LARABEL-EN-LINUX-CON-APACHE2), de lo contrario se presentara problemas
   al desarrollar


7. En el video, en en el tiempo (55:30) la ruta para subir imagenes es "storage/app/public/uploads", las cerpetas se muestran ya creadas, pero en
   la version de Larabel que estamos usando se muestra como "storage/app/public", no debemos crear ninguna carpeta ya que al momento de subir las
   imagenes se crearan automaticamente

https://laravel.com/docs/9.x/migrations#available-column-types


*En el caso que exista dudas sobre el proyecto ver el siguiente tutorial: [CRUD en Laravel 8  - #1](https://youtu.be/FwAI2-cotLI)*

---



#### COMANDOS USADOS

1. Creamos un proyecto con la ultima version de Larabel 8, ya que con
   esa es la que se esta realizando el video
   
    **sistema** = este va a ser el nombre que va tener nuestro proyectos*

```
composer create-project laravel/laravel:8.* sistema
```

* *Si se ha creado correctamente debera mostrar un mensaje como el siguiente al final*

```
Publishing complete.
> @php artisan key:generate --ansi
Application key set successfully.
```

* *Si estamos en sistemas opertivos GNU-Linux/Ubuntu y estamos usando
   Apache y PHP instado por consola, damos el siguiente permiso, despues
   de haber creado el proyecto para evitar que despues nos muestre errores
   de permiso, si estamos en Windows no seguimos este paso*

```
sudo chmod 777 -R /var/www/html/
```

* *Una vez creado el proyecto, podremos visualizar su pagina de inicio
   abriendo la siguiente ruta en el navegador*
   
http://localhost/sistema/public/


2. Este comando permite crear las migraciones en nuestra base de datos,
   es decir que se van a crear las tablas en nuestra base de datos, de 
   acuerdo a los archivo que hayamos creado en la carpeta **database/migrations**
   
```
php artisan migrate
```

* *Si se han creado correctamente las tablas debera mostrarnos un mensaje
   como el siguiente*
   
```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (352.39ms)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (330.13ms)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (308.37ms)
Migrating: 2019_12_14_000001_create_personal_access_tokens_table
Migrated:  2019_12_14_000001_create_personal_access_tokens_table (541.69ms)
```

3. Este comando permite crear un Modelo, Control y Recursos dentro de 
   nuestro proyecto de forma automatica

   **make:model** = permite crear un modelo en nuestro proyecto
   
   **Empleado** = nombre de la clase para crear el CRUD
   
   **-mcr** = esto indica que va a crear Modelo, Control y Recursos, es como
	      crear una clase en Java para Modelo, Vista y Controlador de forma
	      automtica, lo cual sireve mucho para un CRUD

```
php artisan make:model Empleado -mcr
```

4. Este comando permite ver todas las rutas activas de nuestro sistema

```
php artisan route:list
```

5. Este comando permite hacer publico los archivos de la ruta "storage/app/public", con la finalidad de recuperrar los archivos
   que vayamos subiendo en esta ruta, es decir este comando habilita el directorio "public/storage/uploads", donde se podran recuperar
   los archivos, crea como una carpeta espejo de "storage/app/public"

```
php artisan storage:link
```

* *Si se ha ejecutado el comando correctamente debera mostrarnos el siguiente mensaje*
   
```
The [/var/www/html/sistema/public/storage] link has been connected to [/var/www/html/sistema/storage/app/public].
The links have been created.
```

6. Este comando permite integrar tdoda la interfaz de nuestra aplicacion, con este comando podremos integrar el modulo de acceso a toda
   la aplicacion, pero antes de ejecutar el comando debemos leer las notas debajo del comando, porque puede presentar un problema en versiones
   actuales de PHP

```
composer require laravel/ui
```

* *Si se ha ejecutado el comando en la version de PHP 8, puede dar el siguiente error*

```
Problem 1
    - Root composer.json requires laravel/ui ^4.2 -> satisfiable by laravel/ui[v4.2.0, v4.2.1, 4.x-dev].
    - laravel/ui[v4.2.0, ..., 4.x-dev] require illuminate/console ^9.21|^10.0 -> found illuminate/console[v9.21.0, ..., 9.x-dev, v10.0.0, ..., 10.x-dev] but these were not loaded, likely because it conflicts with another require.

You can also try re-running composer require with an explicit version constraint, e.g. "composer require laravel/ui:*" to figure out if any version is installable, or "composer require laravel/ui:^2.1" if you know which you need.
```

* *Para solucionar este problema ejecutamos los siguientes comandos, que son para actualizar composer e instalar una version compatible del paquete **laravel/ui**, con la version de PHP 8*

```
composer update
```

```
composer require laravel/ui:^3.3.0
```


7. Este comando permite integrar el framework de Bootstrap con nuestra aplicacion
   
   **--auth** = aqui le estamos integrando bootstrap con el modulo de autenticacion

```
php artisan ui bootstrap --auth
```

* *Si se ha ejecutado el comando correctamente debera mostrarnos el siguiente mensaje*
   
```
Bootstrap scaffolding installed successfully.
Please run "npm install && npm run dev" to compile your fresh scaffolding.
```

8. Instala todos los módulos necesarios de node para nuestro proyecto, es importante ejecutar estos comandos de node para que nuestra aplicacion se empaquete correctamente

```
npm install
```

* *Si se ha ejecutado el comando correctamente debera mostrarnos el siguiente mensaje*
   
```
added 745 packages, and audited 746 packages in 10s

79 packages are looking for funding
  run `npm fund` for details

found 0 vulnerabilities
```

8. Este comando permite arrancar el servidor de Node automaticamente, en modo desarrollo usando Nodemon, con esto ya podremos visualizar correctamente Bootsatrap en nuestra aplicacion, en algunos casos es necesario ejecutarlo hasta 2 veces

```
npm run dev
```

* *Si se ha ejecutado el comando correctamente debera mostrarnos el siguiente mensaje*


```
✔ Compiled Successfully in 7678ms
┌──────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┬──────────┐
│                                                                                                                     File │ Size     │
├──────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┼──────────┤
│                                                                                                               /js/app.js │ 2.22 MiB │
│                                                                                                              css/app.css │ 230 KiB  │
└──────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────┴──────────┘
webpack compiled successfully
```

---




#### EXTENSIONES VISUAL STUDIO

1. Instalamos la extension **Laravel Snippets**, para poder usar el Framework
   de Laravel


2. Instalamos la extension **Bootstrap v4 Snippets**, para poder usar el 
   Framework de Bootstrap

---

#### INFORMACION DE ARCHIVOS Y CARPETAS DE UN PROYECTO EN LARABEL

**.env** = este archivo permite configurar la conexion con la base de datos y
           otras configuraciones del proyecto
	   
**database/migrations** = dentro de esta carpeta se encuentran archivos donde
			  podremos crear la estructura que va a tener nuestra 
			  base de datos, es decir cada archivo que configuremos
			  sera la forma en como se van a crear las tablas de
			  nuestra base de datos

**app/Models** = aqui se crean los modelos de las clases que creemos con el comando **3.** en la seccion, [COMANDOS USADOS](#COMANDOS-USADOS)

**app/Http/Controllers** = aqui se crean los controladores de las clases que creemos con el comando **3.** en la seccion, 
                           [COMANDOS USADOS](#COMANDOS-USADOS), aqui se crean los metodos del CRUD de cada clase que creemos

**resources** = dentro de esta carpeta se encuentran todos los recursos que va a usar nuestras vistas, como css, hml, javascript

**resources/views** = dentro de esta carpeta se encuentran las vistas que va a tener nuestra aplicación

**routes** = dentro de esta carpeta se encuentran todas las rutas que van usar nuestro sistema

**routes/web.php** = dentro de este archivo se encuentran todas las rutas que van usar nuestras vistas

**storage/app/public** = dentro de esta carpeta se almacenan todos lo archivos que subamos a nuestro proyecto, aunque en el video la ruta es
                         *storage/app/public/uploads*, en esta version de Larabel es la nueva ruta

**resources/views/layouts** = dentro de esta carpeta se encuentran los templates que a usar toda nuestra aplicacion

**app/Providers/AppServiceProvider.php** = este archivo permite configurar la paginación de las listas

---


#### HABILITAR LARABEL EN LINUX CON APACHE2

1. Creamos el siguiente archivo en la configuracion de Apache2

```
sudo nano /etc/apache2/sites-available/laravel.conf
```

* *Agregamos la siguiente configuración al archivo. Si estámos utilizando un nombre de dominio, podemos cambiar el dominio. Además, nos asegúramos de cambiar la ruta de la raíz del documento del proyecto Laravel en el caso que queramos estabelcer otra ruta* 

```
<VirtualHost *:80>

    ServerAdmin admin@hwdomain.io
    ServerName laravelapp.hwdomain.io
    DocumentRoot /var/www/html

    <Directory />
            Options FollowSymLinks
            AllowOverride None
    </Directory>
    <Directory /var/www/html>
            AllowOverride All
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```

2.  Ahora habilitamos la reescritura del módulo Apache2

```
sudo a2enmod rewrite
```

* *Si se ha habilitado correctamente debera mostrar el siguiente mensaje*

```
Enabling module rewrite.
To activate the new configuration, you need to run:
  systemctl restart apache2
```

* *Una vez habilitado reiniciamos el servicio de Apache2*

```
systemctl restart apache2
```

3.  Ahora habilitamos la configuración del host virtual laravel.conf

```
sudo a2ensite laravel.conf
```

* *Si se ha habilitado correctamente debera mostrar el siguiente mensaje*

```
Enabling module rewrite.
To activate the new configuration, you need to run:
  systemctl restart apache2
```

* *Una vez habilitado reiniciamos el servicio de Apache2*

```
systemctl restart apache2
```

4. Ahora verificamos la configuración de Apache2 y verificamos que no haya ningun error

```
sudo apachectl configtest
```

* *Probablemente mostrará la siguiente alerta, pero es por que se ejecuta en localhost, no hay ningun problema con esta alerta*

```
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 127.0.1.1. Set the 'ServerName' directive globally to suppress this message
Syntax OK

```

5. Finalmente reiniciamos el servicio de Apache2 y con esto ya podremos editar nuestra aplicacion de Larabel

```
sudo systemctl restart apache2
```


---


#### COMANDOS PARA EJECUTAR UN PROYECTO DESCARGADO DE GITHUB


1. Instalamos todos los paquetes de Composer

```
composer install
```

2. Instalamos todos los paquetes de Node, es importante ejecutar estos comandos de node para que nuestra aplicacion se empaquete correctamente

```
npm install
```

<?php


// REFERENCIAS DEL PROYECTO

use Illuminate\Support\Facades\Route;

// Creamos la referencia a "app/Http/EmpleadoController.php", para poder
// acceder a las funciones y estas poder enlazarlas con nuestras rutas
use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//RUTAS DEL SISTEMA

//Esta es la ruta principal de nuestro proyecto
Route::get('/', function () {

    //Retornamos una vista a nuestra pagina inicial

    // welcome = esto indica que va a usar el archivo "resources/views/welcome.blade.php", en su ruta
    //           inicial
    //return view('welcome');



    //Retornamos la vista de login como pagina inicial

    // auth.login = esto indica que va a usar el archivo "resources/views/auth/login.blade.php", en su ruta
    //              inicial
    return view('auth.login');
});








//Rutas va a permitir acceder a Empleados


/*** 
// Creacion de rutas de forma manual


//Creamos una ruta para mostrar la lista de empleados

// /empleado = nombre de la ruta a la cual accederiamos desde nuestro navegador 
Route::get('/empleado', function () {
    
    //empleado = este es el nombre de la carpeta "resources/views/empleado" a la que vamos a acceder
    // . = este punto indica que vamos a acceder a todos los archivos que estan dentro de "resources/views/empleado"
    // index = esto indica el nombre del archivo que vamos a ejecutar con nuestra ruta index.blade.php
    return view('empleado.index');
});



//Creamos una ruta para crear un empleado

//[EmpleadoController::class, 'create'] = permite llamar a su clase y a un metodo de la clase
//EmpleadoController = hace referencia a la clase app/Http/EmpleadoController.php, que hemos importado
//::class = permite llamar a una clase
//create = este es el metodo que estamos llamando y que se encuentra dentro de esta clase
Route::get('/empleado/create',[EmpleadoController::class, 'create']);
***/






// Creacion de rutas de forma automatica de nuestra clase y tambien validacion de autenticacion

// Creamos una ruta que permite acceder de forma automatica a todos los metodos
// de app/Http/Controllers/EmpleadoController.php, sin necesidad de crear ruta por ruta

// resource = permite acceder a todos los metodos de nuestra clase sin necesidad de nombrarlos uno a uno

//middleware('auth') = esto permite validar que el usuario se haya logeado para acceder a las rutas de esta
//                     clase, esto es importante agregarlo ya que si no realizmaos esto, a pesar que el usuario
//                     haya cerrado la sesion podremos seguir accediendo al formulario

//middleware = este "middleware", se va a ejecutar antes que todo el resto de codigo

//auth = esto indica que va a usar el modulo de autenticacion
Route::resource('empleado',EmpleadoController::class)->middleware('auth');












//Esta ruta se crea automaticamente cuando creamos el modulo de autenticacion con el 
//comando "php artisan ui bootstrap --auth", y aqui definimos los botones que va a mostrar
//nuestro modulo de autenticacion

//Auth::routes() = la ruta establecida de esta manera indica que se a mostrar todos los botones
//                 del modulo de acceso y asi se crear cuando ejecutamos el comando 
//                 "php artisan ui bootstrap --auth"

//'register'=>false = aqui le estamos indicando el formulario de registro de usuario no se muestre

//'reset'=>false = aqui le estamos indicando que formulario de resetera la contraseña no se muestre
Auth::routes(['register'=>false,'reset'=>false]);














//Creamos la ruta incial donde se va a direccionar la ruta "/home" de la autenticacion, esta ruta se crea cuando
//creamos la autenticacion, en nuestro caso vamos a modificarla de acuerdo a nuestras necesidades


//Ruta que se crea automaticamente

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); = esta ruta se crear automaticamente cuando creamos el 
//                                                                                             modulo de autenticacion con el comando 
//                                                                                             "php artisan ui bootstrap --auth" y nos sirve para establecer

//'/home' = nombre de la ruta

//App\Http\Controllers\HomeController::class = nombre de la clase que va a usar esta ruta y se encuentra en
//                                             "app/Http/Controllers/HomeController.php" 

//index = metodo que va usar esta ruta y se encuentra dentro de la clase

//name('home') = nombre de la ruta que vamos a usar
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Ruta que modificamos
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');











//Creamos una ruta del grupo al cual pertenece la autenticacion, para direccionar
//a una clase en el caso que la autenticacion este correcta

//middleware = este es el tipo de grupo de grupo que vamos a crear y este "middleware", se va a ejecutar
//             antes que todo el resto de codigo

//auth = esto indica que va a usar el modulo de autenticacion, es decir cuando el usuario se logee, se va
//       a ejecutar esta funcion
Route::group(['middleware' => 'auth'], function () {

    //Redireccionamos la ruta inicial "/" a la lista de empleados, una vez que el usuario se haya logeado

    //EmpleadoController::class = nombre de la clase que va a usar esta ruta y se encuentra en
    //                            "app/Http/Controllers/EmpleadoController.php"
    
    //index = metodo que va usar esta ruta y se encuentra dentro de la clase
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});

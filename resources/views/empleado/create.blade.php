
<!-- Esta seccion de codigo es para incluir en esta vista el template que se encuentra en 
     "resources/views/layouts/app.blade.php", este codigo no se crea automaticamente cuando
     creamos los formulario, los debemos incluir manualmente, tambien debemos cerrar "section" y
     <div> al final del archivo-->


<!-- extends('layouts.app') = esto indica que se incluya el template de "resources/views/layouts/app.blade.php"-->     
@extends('layouts.app')
<!-- section('content') = esto indica que todo lo que se encuentre dentro de section, a a ser el cuerpo del
                           template -->
@section('content')
<div class="container">





    <!-- Creamos u formulario para insertar informacion -->

    <!-- {{url('/empleado')}} = esto indica que la informacion de este formulario la vamos a
                                enviar a una ruta de nuestro sistema -->

    <!-- /empleado = este es el nombre de la carpeta "resources/views/empleado" a la que vamos a acceder -->

    <!-- post = este es el metodo por el cual se va a enviar la informacion y hace referencia al metodo 
                "empleado.store", que nos muestra al ejecutar el comando "php artisan route:list" -->

    <!-- @csrf = esto es una llave de seguridad que exige larabel usar para que se sepa que el formulario
                viene del mismo sistema -->

    <!-- @ include('empleado.form') = usamos esta instruccion para incluir un formulario html en est pagina de php,
                                    este formulario se encuentra en "resources/views/empleado/form.blade.php" -->

    <!-- @ include = permite incluir un formulario en esta pagina -->

    <!-- empleado = este es el nombre de la carpeta "resources/views/empleado" a la que vamos a acceder -->

    <!-- form = este es el nombre del archivo "resources/views/empleado/form.blade.php" que va a incluir y que tiene el
                formulario -->

    <!-- ['modo'=>'Crear'] = usamos esta instruccion para crear una variable, la cual va a permitir, indicarle al
                            al boton de "resources/views/empleado/form.blade.php", el texto de si vamos a crear o editar
                            en el formulario -->

    <!-- 'modo' = este es el nombre de la variable que espera recibir el boton del formulario "resources/views/empleado/form.blade.php"-->

    <!-- 'Crear' = este es el valor de la variable y que va mostrar nuestro boton -->
    <form action="{{url('/empleado')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('empleado.form', ['modo'=>'Crear'])    
    </form>


</div>
@endsection


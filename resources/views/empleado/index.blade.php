
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





    <!-- Creamos una validacion para mostrar un mensaje, este mensaje nos sirve para mostrar las 
         acciones hechas en el CRUD, lo mostramos en una alerta de bootstrap con un boton para cerrar
         la alerta -->
    @if(Session::has('mensaje'))

        <!-- @ if(Session::has('mensaje')) = aqui validamos si existe una sesion con la variable mensaje, de
                                             existir va a mostrar el mensaje, caso contrario no va a mostrar nada -->

        <!-- {{ Session::get('mensaje') }} = aqui mostramos el mensaje que le enviemos desde los diferentes metodos
                                             del CRUD de app/Http/Controllers/EmpleadoController.php-->
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"aria-label="Close"></button>
        </div>
    @endif





   





    <!-- Creamos un enlace que permite enviarnos al formulario de crear un nuevo regitro
        en "resources/views/empleado/create.blade.php"  -->

    <!-- url() = permite acceder a una ruta especifica mediante una url -->

    <!-- {{ url('/empleado/create') }} = aqui agregamos la ruta a donde vamos a direccionarnos -->

    <!-- class="btn btn-success" = creamos un estilo de bootstrap a nuestro boton-->
    <a href="{{ url('/empleado/create') }}" class="btn btn-success">Crear</a>



    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Id</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- -->
        <!--Obtenemos la lista de datos en nuestra vista-->


        <!-- foreach(empleados as empleado) = mediante un foreach recorremos la lista de dato -->
                
        <!-- empleados = esta es la variable de "app/Http/Controllers/EmpleadoController.php" del metodo index()
                            que retorna en esta variable la lista de datos -->
        
        <!-- empleado = esta sera la variable que almacenara el recorrido de cada dato -->

        <!-- { empleado -> id} = este es el primer campo obtenido en el recorrido, el campo debe llamarse igual
                                    que el campo de la base de datos de nuestra tabla -->
        <tbody>
            
            @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id}}</td>

                
                <!-- Recuperamos nuestra imagen -->

                <!-- {{ asset('storage').'/'.$empleado->foto }} = aqui obtenemos la ruta de la imagen para poder mostrarla
                                                                pero antes ya debemos haber ejecutado el comando "php artisan storage:link"-->
                
                <!-- asset('storage') = esto permite obtener la ruta de "public/storage/uploads" donde se encuentran las imagenes, este directorio
                                        se habilito al haber ejecutado el comando "php artisan storage:link"-->

                <!-- . = esto permite concatenar -->

                <!-- $empleado->foto = obtenemos el nombre de la foto que vamos a mostrar -->

                <!-- class="img-thumbnail img-fluid" = creamos un estilo de bootstrap a nuestra imagen-->
                <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto }}"  width="100" alt=""></td>
            

                <td>{{ $empleado->nombre}}</td>
                <td>{{ $empleado->apellido_paterno}}</td>
                <td>{{ $empleado->apellido_materno}}</td>
                <td>{{ $empleado->correo}}</td>

                <td>

                    <!-- Creamos un formulario para pasar el id del registro que vamos a eliminar -->


                    <!-- {{ url('/empleado/'.$empleado->id) }} = aqui pasamos el id del dato que vamos a eliminar -->

                    <!-- url() = permite enviar la informacion de un formulario a una url epecifica-->

                    <!--/empleado/ =  hace referencia al metodo "empleado.destroy", que nos muestra al ejecutar el comando 
                                    "php artisan route:list" -->
                    
                    <!-- . = esto permite concatenar -->

                    <!-- $empleado->id = obtenemos el id del dato que queremos eliminar -->

                    <!-- class="d-inline" = este estilo de bootstrap nos permite alinear los botones -->
                    <form action="{{ url('/empleado/'.$empleado->id) }}" class="d-inline" method="post">
                    <!-- @csrf = esto es una llave de seguridad que exige larabel usar para que se sepa que el formulario
                                viene del mismo sistema --> 
                    
                    <!-- {{ method_field('DELETE') }} = agregamos el metodo por el cual enviamos la informacion -->

                    <!-- method_field() = permite elegir un metodo HTTP, por el cual enviamos la informacion -->

                    <!-- DELETE = este es el metodo por el cual se va a enviar la informacion y hace referencia al metodo 
                                "empleado.destroy", que nos muestra al ejecutar el comando "php artisan route:list" -->

                    <!-- class="btn btn-danger" = creamos un estilo de bootstrap a nuestro boton-->
                    @csrf
                    {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-danger" value="Borrar" onclick="return confirm('¿Quieres borrar?')">
                    </form> |



                    


                    <!--  Creamos un enlace para actualizar la informacion -->

                    <!-- .'/edit' = este es el nombre del archivo "resources/views/empleado/edit.blade.php" que tiene el
                                    formulario donde le vamos a pasar los datos para actualizar, este formulario lo estamos
                                    concatenando-->
                    
                    <!-- class="btn btn-warning" = creamos un estilo de bootstrap a nuestro boton-->
                    <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">Actualizar</a>
                </td>

            </tr>
            @endforeach
            
        </tbody>
    
    </table>


    <!-- Creamos el paginado de nuestros registros, pero antes de implementar esto ya demeos haber configurado
         en "app/Providers/AppServiceProvider.php" el codigo necesario -->

    <!-- empleados = esta es la variable de "app/Http/Controllers/EmpleadoController.php" del metodo index()
                     que retorna en esta variable la lista de datos -->

    <!-- links() = aqui le estamos indicando que nos muestre en enlaces los registros, mediante esto podemos
                   mostrar el paginado-->
    {!! $empleados->links() !!}
</div>
@endsection
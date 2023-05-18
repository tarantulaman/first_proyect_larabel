
<!-- Mostramos un titulo en nuestra etiqueta que viene de los formularios 
"resources/views/empleado/form.create.php" y "resources/views/empleado/form.edit.php"-->

<!-- $modo = este es el nombre de la variable que espera recibir su valor la etiqueta y sera
             Crear o Editar, dependiendo del formulario-->

<h1>{{ $modo }} empleado</h1>







<!-- Creamos una comprobacion de errores para realizar la validacion del formulario y los mostramos
     en una lista de bootstrap-->

<!-- if(count($errors)>0) = aqui le estamos indicando que cuente los errores y si existe mas de 0 errores
                             muestre los mensajes de validacion en nuestro formulario -->
@if(count($errors)>0)

     <div class="alert alert-danger" role="alert">
          <ul>
               <!-- Vamos a mostrar los errores de 1 en 1 mediante un foreach -->

               <!-- errors -> all() = aqui le estamos indicando que muestre todos los errores -->
               <!-- error = aqui le estamos indicando que cada error se almacene en esta variable para irlos mostrando-->
               <!-- { error }= aqui estamos imprimiendo el error -->
               @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
               @endforeach
          </ul>
     </div>
  
@endif








<!-- Este formulario va a servir tanto para crear como para editar, de hace de esta manera para
     evitar trabajar doble al crear un formulario para cada accion-->

<!-- name="nombre" = este es el nombre del campo que va a ser utilizado para crear, editar y debe escribirse  
                     tal cual como hemos creado en "database/migrations/2023_04_14_001550_create_empleados_table.php" -->

<!-- value="$ empleado->nombre" = esto va a funcionar solo para el formulario de editar, aqui recuperamos
                                   la informacion del empleado-->

<!-- isset( $ empleado->nombre)?$empleado->nombre:'' = aqui estamos preguntando si existe el valor "$empleado->nombre", vamos 
                                                     a mostrar "$empleado->nombre" dentro de la caja de texto caso contrario 
                                                     no vamos a mostrar nada, esta validacion sirve para el formulario de 
                                                     crear, ya que si no realizamos esta validacion va a dar un error-->

<!-- ? = esto indica que si existe el valor "$empleado->nombre" va a mostrar el valor "$empleado->nombre" --> 

<!-- : = esto inddica caso contrario va a mostrar un valor especifico, en este caso un valor vacio que son las comillas simples
         pero si lo dejamos solo de esta manera si el usuario a llenado varios campos y se realiza la validacion toda 
         la informacion ingresada se va a eliminar -->

<!-- old('nombre') = esto permite que si el usuario a llenado varios campos y se realiza la validacion toda 
                    la informacion ingresada no se va a eliminar, se conserva el valor llenado, es importante poner el
                    nombre del mismo campo -->

<!-- Todos los <div> y class son estilo de bootstrap, si los quitamos no afecta a la funcionalidad de la aplicacion-->
<div class="form-group">
     <label for="nombre">Nombre</label>
     <input type="text" class="form-control" name="nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" id="nombre">   
</div>

<div class="form-group">
     <label for="apellido_paterno">Apellido Paterno</label>
     <input type="text" class="form-control" name="apellido_paterno" value="{{ isset($empleado->apellido_paterno)?$empleado->apellido_paterno:old('apellido_paterno')}}" id="apellido_paterno">   
</div>

<div class="form-group">
     <label for="apellido_materno">Apellido Materno</label>
     <input type="text" class="form-control" name="apellido_materno" value="{{ isset($empleado->apellido_materno)?$empleado->apellido_materno:old('apellido_materno') }}" id="apellido_materno">   
</div>

<div class="form-group">
     <label for="correo">Correo</label>
     <input type="text" class="form-control" name="correo"  value="{{ isset($empleado->correo)?$empleado->correo:old('correo') }}" id="correo">   
</div>



<div class="form-group">

     <label for="foto">Foto</label>

     <!-- Aqui realizamos la validacion de la foto usando un if -->
     @if(isset($empleado->foto))

     <!-- Obtenemos el nombre de la foto -->
     <!--{{ $empleado->foto}}-->

     <!-- Recuperamos nuestra imagen -->

     <!-- {{ asset('storage').'/'.$empleado->foto }} = aqui obtenemos la ruta de la imagen para poder mostrarla
                                                       pero antes ya debemos haber ejecutado el comando "php artisan storage:link"-->

     <!-- asset('storage') = esto permite obtener la ruta de "public/storage/uploads" donde se encuentran las imagenes, este directorio
                              se habilito al haber ejecutado el comando "php artisan storage:link"-->

     <!-- . = esto permite concatenar -->

     <!-- $empleado->foto = obtenemos el nombre de la foto que vamos a mostrar -->

     <!-- class="img-thumbnail img-fluid" = creamos un estilo de bootstrap a nuestra imagen-->
     <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto }}" width="100" alt="">
     @endif
     <input type="file" class="form-control" name="foto" id="foto">   
</div>





<!-- Mostramos un mensaje en nuestro boton que viene de los formularios 
"resources/views/empleado/form.create.php" y "resources/views/empleado/form.edit.php"-->

<!-- $modo = este es el nombre de la variable que espera recibir su valor el boton y sera
             Crear o Editar, dependiendo del formulario-->
<input type="submit" class="btn btn-success" value="{{$modo}} datos">





<!-- Creamos un enlace que permite enviarnos la lista de datos "resources/views/empleado/index.blade.php" -->

<!-- url() = permite acceder a una ruta especifica mediante una url -->

<!-- {{ url('/empleado/') }} = aqui agregamos la ruta a donde vamos a direccionarnos -->
<a href="{{ url('/empleado/') }}" class="btn btn-primary">Regresar</a>


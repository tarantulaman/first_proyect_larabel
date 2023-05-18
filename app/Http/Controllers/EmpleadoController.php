<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

//Importamos esta clase que va a contener varios elementso que nos va a permitir 
//borrar la imagen de nuestra ruta "storage/app/public", en el caso que cambiemos de imagen
//cuando actualicemos algun dato 
use Illuminate\Support\Facades\Storage;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos los datos de "Empleados" y lo almacenamos en una variable

        //$datos['empleados'] = variable que va a almacenar la lista de empleados
        
        //$empleados = este va a ser el nombre por el cual va ser llamado desde la vista
        
        //Empleado = nombre de la clase "Empleados" que va a traer todos los datos ubicada en "app/Models/Empleado.php"
        
        //::paginate(1) = aqui indicamos que los datos obtenidos va a mostrar de 1 en 1, lo podemos cambiar
        //                de acuerdo a nuestra necesidad, pero en este caso lo usamos asi porque nesitamos
        //                mostrar la paginacion, de esta manera se van a mostrar en "resources/views/empleado/index.blade.php"
        $empleados = Empleado::paginate(1);


        //Retornamos la vista de empleado para listar, con su lista de datos

        //empleado = este es el nombre de la carpeta "resources/views/empleado" a la que vamos a acceder
        // . = este punto indica que vamos a acceder a todos los archivos que estan dentro de "resources/views/empleado"
        // index = esto indica el nombre del archivo que vamos a ejecutar con nuestra clase index.blade.php
        //compact = permite crear un arreglo con la informacion que almacena las variables, es necesario ponerlo para usarlo en la vista
        //'empleados' = esta es la variable que anteriormente hemos creado y que almacena la lista de datos y con la que recuperaremos en la vista
        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Retornamos la vista de empleado para crear

        //empleado = este es el nombre de la carpeta "resources/views/empleado" a la que vamos a acceder
        // . = este punto indica que vamos a acceder a todos los archivos que estan dentro de "resources/views/empleado"
        // create = esto indica el nombre del archivo que vamos a ejecutar con nuestra vista create.blade.php
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Recibimos todos lo datos que se van a enviar desde el formulario "resources/views/empleado/create.blade.ph"
        //ya que este formulario ejecuta este metodo
        //$datosEmplado = request()->all();


        //Aqui recibimos todos los datos a excepcion del token de seguridad ya que este no
        //lo vamos a insertar en la base de datos

        //'_token' = este es el nombre del campo que no queremos recibirlo
        $datosEmplado = request()->except('_token');








        //Realizamos una validacion de campos del formulario


        //Creamos un arreglo de datos donde incluimos los nombres de los campos, el tipo de dato
        //que espera aceptar y el tamaño

        //nombre = este es el nombre del campo que va a ser validado y debe escribirse tal cual como hemos 
        //         creado en "database/migrations/2023_04_14_001550_create_empleados_table"

        //required = aqui le indicamos que este campo es requerido que se valide

        //string= aqui le indicamos que este campo va a solo recibir valores de tipo string

        //max:100 = aqui le estamos indicando el numero de caracteres que este campo a permitir escribir

        //email = aqui le indicamos que este campo valide un email

        //mimes:jpeg,png,jpg = aqui le estamos indicando el tipo de archivo que espera recibir este campo
        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'correo' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
            
        ];




        //Creamos los mensajes de validacion que van a mostrarse en el formulario

        //required' = aqui se esta refiriendo a que todos los campos que lleven 'required', en el anterior
        //            arreglo va a mostrar el siguiente mensaje

        //:attribute = aqui se va a poner el nombre de cada campo, es decir 'nombre', 'apellido_paterno', etc, 
        //             dependiendo del campo que falte validar, esto es como un alias

        //foto.required = aqui estamos accediendo solo al campo de la foto, para mostrar un mensaje especifico
        //                ahi, lo hacemos de esta manera ya con el mensaje de 'required', no tiene mucho sentido
        $mensaje=[
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida'
        ];




        //Unimos los arreglos de $campos y $mensaje, para realizar la validacion

        //$this = esto permite ejecutar los arreglos
        //validate = permite realizar la validacion de formulario con sus arreglos
        //$request = esto indica que se ejecute el requerimiento de validacion
        //$campos = esto indica que se valide los campos establecidos
        //$mensaje = indica que se muestren los mensajes establecidos
        $this->validate($request, $campos, $mensaje);











        //Realizamos un validacion para obtener la ruta de la imagen e insertarlo en nuestra base de datos
        //ya que si no hacemos esto se va almacenar en una ruta temporal

        //$request->hasFile('Foto') = aqui validamos si existe un archivo en el campo "Foto" que viene del 
        //                            formulario "resources/views/empleado/create.blade.php"
        if($request->hasFile('foto')){

            //Aqui obtenemos la foto y lo almacenamos en  un directorio publico del proyecto

            //$datosEmplado['Foto'] = obtenemos el campo "Foto" que viene del 
            //                        formulario "resources/views/empleado/create.blade.php"

            //$request->file('Foto') = aqui obtenemos el nombre de la fotografia que estamos insertando

            //store('uploads','public') = aqui estamos indicando la ruta donde vamos a almacenar la fotografia


            //'uploads' = esta es la carpeta donde se van a almacenar las imagenes que subamos es decir en 
            //            "storage/app/public/uploads", si no existe esta carpeta no es necesario crearla ya que
            //            al insertar un dato se va a crear automaticamente, es importante crear una carpeta
            //            sea con este nombre o con cualquiera, ya que si no la creamos al momento de recuperar la
            //            imagen va a dar un problema, ya que si solo usamos "store('public')", se va almacenar la
            //            ruta de la imagen como "public/nombre_imagen.png" en la base de datos y al momento de llamarla
            //            se va a recuperar como http://localhost/sistema/public/storage/public/nombre_imagen.png, logrando
            //            asi que no se recupere la imagen y de error 404 al llamara a la imagen

            //'public' = esta es la ruta publica del proyecto donde se suben nuestros archivos "storage/app/public"
            //           es obligatorio agregarla
            $datosEmplado['foto'] = $request->file('foto')->store('uploads','public');
        }


        //Insertamos los datos del formulario en la base de datos
        Empleado::insert($datosEmplado);

        



        //Retornamos los datos recibidos en formato json
        //return response()->json($datosEmplado);






        //Direccionamos a la lista de empleados, pasandole un mensaje de que se
        //ha agregado el registro con exito

        //'mensaje' = este es el nombre de la variable que se encuentra en la vista y que espera recibir
        //            un valor, este se encuentra en resources/views/empleado/index.blade.php

        //'Empleado agregado con éxito' = valor que le vamos a pasar a nuestra variable
        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($idEmpleado)
    {
        //Vamos a obtener los datos en nuestro formulario de acuerdo a su id

        //findOrFail() = permite buscar la informacion del empleado que hayamos selccionado
        //               para editarlo, de acuerdo al id que le pasemos

        //$idEmpleado = este es el id del empleado que espera recibr la funcion, para buscar la informacion
        //              del empleado
        $empleado = Empleado::findOrFail($idEmpleado);




        //Retornamos la vista de empleado para editar, es decir para obtener los datos
        //que vamos actualizar, tambien le vamos a pasar la informacion del emepleado seleccionado

        //empleado = este es el nombre de la carpeta "resources/views/empleado" a la que vamos a acceder
        // . = este punto indica que vamos a acceder a todos los archivos que estan dentro de "resources/views/empleado"
        // edit = esto indica el nombre del archivo que vamos a ejecutar con nuestra vista edit.blade.php
        //compact('empleado') = esto permite mantenernos dentro del mismo formulario
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idEmpleado)
    {

        //Realizamos una validacion de campos del formulario


        //Creamos un arreglo de datos donde incluimos los nombres de los campos, el tipo de dato
        //que espera aceptar y el tamaño
        $campos=[
            'nombre' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:100',
            'apellido_materno' => 'required|string|max:100',
            'correo' => 'required|email',
            
        ];


        //Creamos los mensajes de validacion que van a mostrarse en el formulario
        $mensaje=[
            'required' => 'El :attribute es requerido',
        ];



        //Realizamos una validacion para obtener la ruta de la imagen ya que no es necesario que el usuario
        //cargue una nueva imagen si solo desea cambiar algun dato del formulario
        if($request->hasFile('foto')){

            //Tanto $campos y $mensaje son los mismos que se usan en el metodo de guardar
            //"public function store(Request $request)", pero en este caso lo usamos en esta validacion
            //de actualizacion
            $campos=[
                'foto' => 'required|max:10000|mimes:jpeg,png,jpg',
            ];

            $mensaje=[
                'foto.required' => 'La foto es requerida'
            ];

        }



        //Unimos los arreglos de $campos y $mensaje, para realizar la validacion
        $this->validate($request, $campos, $mensaje);











        //Recibimos todos lo datos que se van a enviar desde el formulario "resources/views/empleado/edit.blade.ph"
        //ya que este formulario ejecuta este metodo


        //Aqui recibimos todos los datos a excepcion del token de seguridad y el metodo ya que estos no
        //los vamos a actualizar en la base de datos

        //'_token' = este es el nombre del campo que no queremos recibirlo
        //'_method' = este es el nombre de otro campo que no queremos recibirlo
        $datosEmplado = request()->except(['_token','_method']);



        //Realizamos una validacion para obtener la ruta de la imagen y actualizarla en nuestra base de datos
        //ya que si no hacemos esto se va almacenar en una ruta temporal
        if($request->hasFile('foto')){

            //Vamos a obtener los datos en nuestro formulario de acuerdo a su id
            //para despues obtener la informacion de la fotografia antigua y nueva
            $empleado = Empleado::findOrFail($idEmpleado);



            //Eliminamos la imagen antigua en "storage/app/public/uploads", en el caso que decidamos cambiar de imagen

            //Storage::delete = permite eliminar un archivo de "storage/app/public/uploads"
            //public/ = se refiere a la ruta ""storage/app/public", en la cual va a buscar el archivo
            //. = permite concatenar la informacion
            //.$empleado->foto = concatenamos el datos de la foto para eliminarla
            Storage::delete('public/'.$empleado->foto);


            //Aqui obtenemos la imagen nueva y la almacenamos en  un directorio publico del proyecto
            $datosEmplado['foto'] = $request->file('foto')->store('uploads','public');
        }





        //Actualizamos los datos del formulario en la base de datos
        Empleado::where('id','=',$idEmpleado)->update($datosEmplado);


        //Vamos a obtener los datos en nuestro formulario de acuerdo a su id
        $empleado = Empleado::findOrFail($idEmpleado);

        
        //Direccionamos a la lista de empleados
        return redirect('empleado')->with('mensaje', 'Empleado modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEmpleado)
    {

        //Vamos a obtener los datos en nuestro formulario de acuerdo a su id
        //para despues obtener la informacion de la fotografia que vamos a eliminar
        $empleado = Empleado::findOrFail($idEmpleado);


        //Eliminamos la imagen en "storage/app/public/uploads" y realizamos una validacion
        //para despues de eliminar la imagen, proceder a eliminar los datos

        //Storage::delete = permite eliminar un archivo de "storage/app/public/uploads"
        //public/ = se refiere a la ruta ""storage/app/public", en la cual va a buscar el archivo
        //. = permite concatenar la informacion
        //.$empleado->foto = concatenamos el datos de la foto para eliminarla
        if(Storage::delete('public/'.$empleado->foto)){

            //Eliminamos el empleado de acuerdo a su id
            Empleado::destroy($idEmpleado);
        }


        

        //Direccionamos a la lista de empleados, pasandole un mensaje de que se
        //ha borrado el registro con exito
        return redirect('empleado')->with('mensaje', 'Empleado borrado con éxito');
    }
}

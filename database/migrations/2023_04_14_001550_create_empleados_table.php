<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {

            //Este es la llave primaria que se crear automaticamente cuando creamos la clase
            $table->id();

            $table->string("nombre");
            $table->string("apellido_paterno");
            $table->string("apellido_materno");
            $table->string("correo");
            $table->string("foto");
            
            //Este es un campo de tiempo que se crea automaticamente cuando creamos la clase
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}

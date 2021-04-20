<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('roles', function (Blueprint $table) {
            $table->bigInteger('id_rol')->unsigned();
            $table->string('name',191);
            $table->primary('id_rol');
        });


        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('surname',191);
            $table->string('email',191)->unique();
            $table->string('phone',191);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',191);
            $table->bigInteger('id_rol')->unsigned();

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_rol')
            ->references('id_rol')
            ->on('roles')
            ->onDelete('restrict');
        });

        Schema::create('permisos', function (Blueprint $table) {
            $table->bigInteger('id_permiso')->unsigned();
            $table->string('permiso',191);
            $table->primary('id_permiso');
        });

        Schema::create('detalle_permisos', function (Blueprint $table) {
            $table->bigInteger('id_permiso')->unsigned();
            $table->bigInteger('id_rol')->unsigned();

            $table->foreign('id_permiso')
            ->references('id_permiso')
            ->on('permisos')
            ->onDelete('restrict');

            $table->foreign('id_rol')
            ->references('id_rol')
            ->on('roles')
            ->onDelete('restrict');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

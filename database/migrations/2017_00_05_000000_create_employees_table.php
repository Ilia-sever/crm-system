<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enable')->nullable();
            $table->rememberToken();
            $table->integer('role_id')->unsigned()->default(0);
            $table->string('email', 100);
            $table->string('password', 256)->nullable();
            $table->string('surname', 100)->nullable();
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('post', 100)->nullable();
            $table->string('tel',20)->nullable();
            $table->string('skype', 100)->nullable();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

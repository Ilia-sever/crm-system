<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enable')->nullable();
            $table->enum('status', ['began', 'complete', 'failed']);
            $table->string('name',100);
            $table->date('deadline')->nullable();
            $table->time('plaintime');
            $table->integer('workarea_id')->unsigned()->nullable();
            $table->integer('stage_id')->unsigned()->nullable();
            $table->integer('director_id')->unsigned()->nullable();
            $table->integer('executor_id')->unsigned()->nullable();
            $table->text('description', 10000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

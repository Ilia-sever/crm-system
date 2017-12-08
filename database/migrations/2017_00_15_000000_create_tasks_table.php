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
            $table->time('plaintime')->nullable();
            $table->integer('workarea_id')->unsigned()->nullable();
            $table->integer('stage_id')->unsigned()->nullable();
            $table->integer('director_id')->unsigned()->nullable();
            $table->integer('executor_id')->unsigned()->nullable();
            $table->text('description', 10000)->nullable();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('workarea_id')->references('id')->on('workareas')->onDelete('set null');
            $table->foreign('stage_id')->references('id')->on('stages')->onDelete('set null');
            $table->foreign('director_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('executor_id')->references('id')->on('employees')->onDelete('set null');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('viewed')->nullable();
            $table->dateTime('datetimeof');
            $table->string('title',100);
            $table->string('text', 1000)->nullable();
            $table->string('link',250);
            $table->integer('employee_id')->unsigned()->nullable();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

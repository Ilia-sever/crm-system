<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocnetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socnetworks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resource',100);
            $table->string('link',256);
            $table->integer('employee_id')->unsigned()->nullable();
            $table->integer('contact_id')->unsigned()->nullable();
        });

        Schema::table('socnetworks', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socnetworks');
    }
}

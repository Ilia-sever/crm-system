<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enable')->nullable();
            $table->string('name',100);
            $table->dateTime('datetimeof');            
            $table->string('link',1000);
            $table->integer('author_id')->unsigned()->nullable();
        });

        Schema::table('documents', function (Blueprint $table) {

            $table->foreign('author_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('task_id')->unsigned()->nullable();
        });

        Schema::table('attachments', function (Blueprint $table) {

            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}

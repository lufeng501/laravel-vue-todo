<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTodoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_details', function (Blueprint $table) {
            $table->increments('id')->comment('唯一ID');
            $table->string('title')->comment('标题');
            $table->integer('status')->default(0)->comment('状态');
            $table->unsignedInteger('list_id')->comment('待办事项ID');
            $table->timestamps();
            $table->foreign('list_id')->references('id')->on('todo_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_details');
    }
}

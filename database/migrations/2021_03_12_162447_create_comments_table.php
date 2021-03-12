<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('post_id');
            $table->bigInteger('user_id');
            $table->text('comment');
            // $table->foreign('post_id')
            //     ->references('id')->on('posts')
            //     ->onDelete('cascade');
            // $table->foreign('user_id')
            //     ->references('id')->on('users')
            //     ->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}

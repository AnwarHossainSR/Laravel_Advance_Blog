<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userrequests', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('name');
            $table->string('email');
            $table->string('status');
            $table->string('type');
            $table->string('reqType');
            $table->string('message');
            $table->integer('totalComment');
            $table->string('profileImage');
            $table->string('joined');
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
        Schema::dropIfExists('userrequests');
    }
}

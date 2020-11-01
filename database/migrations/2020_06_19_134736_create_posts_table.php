<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        //gegevens van een post of in dit geval wish
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            // ik weet niet wat unsigned betekent maar dit heeft wel te maken met de relationship van de user en de post
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->integer('price');
            $table->text('body');
            $table->binary('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}


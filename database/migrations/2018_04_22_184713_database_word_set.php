<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseWordSet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });
        Schema::create('subcategory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('category');
            $table->string('name');
            $table->string('description');
        });

        Schema::create('word_set', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('lang1_id')->unsigned()->default(1);
            $table->foreign('lang1_id')->references('id')->on('lang');
            $table->integer('lang2_id')->unsigned()->default(1);
            $table->foreign('lang2_id')->references('id')->on('lang');
            $table->integer('subcategory_id')->unsigned()->default(1);
            $table->foreign('subcategory_id')->references('id')->on('subcategory');
            $table->text('words');
            $table->integer('quant');
            $table->string('name');
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
        Schema::dropIfExists('lang');
        Schema::dropIfExists('category');
        Schema::dropIfExists('sub_category');
        Schema::dropIfExists('word_set');
        Schema::dropIfExists('word');
    }
}

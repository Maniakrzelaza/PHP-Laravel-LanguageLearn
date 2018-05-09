<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('roles', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
        });


        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->default(1);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('roles')->insert(array(
            'name' => 'User',
            'description' => 'Normal role'

        ));
        DB::table('roles')->insert(array(
            'name' => 'Editor',
            'description' => 'Editor can edit things'

        ));
        DB::table('roles')->insert(array(
            'name' => 'Super Editor',
            'description' => 'Super Editor can do more than editor'

        ));
        DB::table('roles')->insert(array(
            'name' => 'Admin',
            'description' => 'Admin is always right'

        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}

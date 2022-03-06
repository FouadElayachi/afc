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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('provider')->default("null");
            $table->string('provider_id')->default("null");
            $table->string('first_name_fr');
            $table->string('last_name_fr');
            $table->string('first_name_ar');
            $table->string('last_name_ar');
            $table->integer('lang')->default(0); //0:arabe 1:français 
            $table->integer('type')->default(0); //0:user 1:admin 
            $table->boolean('is_active')->default(false);
            $table->dateTime('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

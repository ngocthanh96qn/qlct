<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_systems', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name_FB');
            $table->string('id_userFB');
            $table->string('token');
            $table->string('app_id');
            $table->string('app_secret');
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
        Schema::dropIfExists('config_systems');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeTraining extends Migration
{

    public function up()
    {
        Schema::create('type_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('class', ['Offline', 'Online']);
            $table->string('quota', 2);
            $table->text('excerpt');
            $table->text('desc');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('type_training');
    }
}
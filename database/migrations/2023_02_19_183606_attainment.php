<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypeTraining;
use App\Models\User;

class Attainment extends Migration
{
    public function up()
    {
        Schema::create('attainments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeTraining::class);
            $table->foreignIdFor(User::class);
            $table->string('link');
            $table->string('image')->nullable();
            $table->text('excerpt');
            $table->text('desc');
            $table->string('value', 2)->nullable();
            $table->enum('status', ['NoPublikasi', 'Publikasi']);
            $table->text('comment');
            $table->enum('is_active', ['0', '1']);
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
        Schema::dropIfExists('attainment');
    }
}
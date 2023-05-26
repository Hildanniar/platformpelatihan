<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypeTraining;
use App\Models\Participant;
use App\Models\MateriTask;

class Attainment extends Migration
{
    public function up()
    {
        Schema::create('attainments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeTraining::class);
            $table->foreignIdFor(Participant::class);
            $table->foreignIdFor(MateriTask::class);
            $table->string('link');
            $table->string('image')->nullable();
            $table->text('excerpt');
            $table->text('desc');
            $table->string('value', 2)->nullable();
            $table->enum('status', ['NoPublikasi', 'Publikasi']);
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
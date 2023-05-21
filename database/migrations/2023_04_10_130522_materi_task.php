<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypeTraining;
class MateriTask extends Migration
{

    public function up()
    {
        Schema::create('materi_tasks', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('type_training_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(TypeTraining::class)->onDelete('cascade');
            $table->string('name_materi');
            $table->string('bab_materi');
            $table->text('excerpt_materi');
            $table->text('body_materi');
            $table->string('file_materi')->nullable();
            $table->string('name_task');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('desc_task');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materi_tasks');
    }
}
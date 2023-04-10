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
            $table->foreignIdFor(TypeTraining::class);
            $table->text('excerpt_materi');
            $table->text('body_materi');
            $table->string('file_materi')->nullable();
            $table->string('task_name');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Participant;
use App\Models\TypeTraining;
class TrainingParticipants extends Migration
{
    
    public function up()
    {
        Schema::create('training_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Participant::class);
            $table->foreignIdFor(TypeTraining::class);
            $table->text('comment')->nullable();
            $table->enum('status', ['NoPublikasi', 'Publikasi']);
            $table->enum('is_active', ['0', '1']);
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('training_participants');
    }
}
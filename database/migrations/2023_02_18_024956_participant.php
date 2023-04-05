<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use App\Models\TypeTraining;
class Participant extends Migration {
    /**
    * Run the migrations.
    *
    * @return void
    */

    public function up() {
        Schema::create( 'participants', function ( Blueprint $table ) {
            $table->id();
            // $table->foreignIdFor(TypeTraining::class);
            $table->foreignId('type_training_id');
            $table->foreignId('id_user');
            $table->string('name');
            $table->string('email')->unique();
            $table->text('address');
            $table->string('no_hp', 13);
            $table->enum('class', ['Offline', 'Online']);
            $table->enum('is_active', ['0', '1']);
            $table->timestamps();
        });
        
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */

    public function down() {
        //
    }
}

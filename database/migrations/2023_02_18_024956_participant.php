<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypeTraining;
use App\Models\User;
class Participant extends Migration {
    /**
    * Run the migrations.
    *
    * @return void
    */

    public function up() {
        Schema::create( 'participants', function ( Blueprint $table ) {
            $table->id();
            $table->foreignIdFor(TypeTraining::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->text('address');
            $table->string('age', 3)->nullable();
            $table->string('no_hp', 13)->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('profession');
            $table->string('no_member')->nullable();
            $table->string('image')->nullable();
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

    public function down() {
        //
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->text('address');
            $table->string('age', 3);
            $table->string('no_hp', 13);
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('profession');
            $table->string('no_member');
            $table->string('image')->nullable();
            $table->enum('is_active', ['0', '1']);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
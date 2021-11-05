<?php

use App\Enums\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 20);
            $table->string('surname', 40);
            $table->string('patronymic', 20)->nullable();
            $table->integer('age');
            $table->string('phone', 11)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('message', 100);
            $table->enum('gender', [Gender::MALE, Gender::FEMALE]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeals');
    }
}

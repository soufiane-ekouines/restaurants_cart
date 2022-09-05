<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->default(null);;
            $table->string('importent')->default(null);;
            $table->string('message');
            $table->boolean('read_')->default(false);
            $table->foreignId('userSend_id')->constrained('users','id');
            $table->foreignId('userGet_id')->constrained('users','id');
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
        Schema::dropIfExists('messages');
    }
};

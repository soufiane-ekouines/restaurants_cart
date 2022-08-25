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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
            $table->foreignId('cat_id')->constrained()->onDelete('cascade');;
            $table->double('prix');
            $table->integer('qte')->default(0);
            $table->boolean('enable_qte')->default(1);
        
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
        Schema::dropIfExists('products');
    }
};

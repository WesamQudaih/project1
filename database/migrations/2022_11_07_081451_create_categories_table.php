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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->boolean('active')->default(true);
            //1- Create new Column with same data type
            // $table->foreignId('user_id');
            //2- Create foreign key index
            // $table->foreign('user_id')->on('users')->references('id');

            $table->foreignId('user_id')->constrained();

            // $table->string('user_email', 100);
            // $table->foreign('user_email')->on('users')->references('email');

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
        Schema::dropIfExists('categories');
    }
};

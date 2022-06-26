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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->string('file')->nullable();
            $table->string('size')->nullable();
            $table->string('type')->nullable();
            $table->date('date')->default(date('Y-m-d'));
            $table->integer('category_id');
            $table->boolean('status')->default(0)->comment('0 - oddiy hujjat 1 - maxsus hujjat');
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
        Schema::dropIfExists('homes');
    }
};

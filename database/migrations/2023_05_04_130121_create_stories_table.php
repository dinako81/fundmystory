<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('text', 2000);
            $table->unsignedTinyInteger('status')->default(1);
            $table->decimal('totalamount', 6, 2)->unsigned();
            $table->decimal('donatedamount', 6, 2)->unsigned()->nullable();
            $table->decimal('restamount', 6, 2)->unsigned()->nullable();
            $table->string('photo', 200)->nullable()->default(null);
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
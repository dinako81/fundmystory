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
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedTinyInteger('status')->default(1);
            $table->decimal('totalfund', 6, 2)->unsigned();
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
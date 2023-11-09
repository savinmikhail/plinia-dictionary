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
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->string('word')->unique()->nullable();
            $table->string('translation')->nullable();
            $table->string('transcription')->nullable();
            $table->string('level')->nullable();
            $table->string('part_of_speech')->nullable();
            $table->string('definition')->nullable();
            $table->string('example')->nullable();
            // $table->string('userEmail')->nullable();
            // $table->string('audioPath')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies');
    }
};

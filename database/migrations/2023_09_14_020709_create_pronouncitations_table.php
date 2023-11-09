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
        Schema::create('pronouncitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vocabulary_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('user_email');
            $table->string('recognized_word')->nullable();
            $table->string('audio_path')->nullable();
            $table->decimal('coincidence')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pronouncitations');
    }
};

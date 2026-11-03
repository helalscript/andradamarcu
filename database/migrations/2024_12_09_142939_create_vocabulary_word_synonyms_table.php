<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vocabulary_word_synonyms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vocabulary_word_id')->constrained()->onDelete('cascade');
            $table->string('synonym');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabulary_word_synonyms');
    }
};

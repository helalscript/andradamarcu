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
        Schema::create('content_c_m_s', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['how_to_use','privacy_policy'])->nullable(); 
            $table->integer('position')->nullable();
            $table->longText('content')->nullable();
            $table->longText('description')->nullable();
            $table->string('logo')->nullable(); 
            $table->enum('status',['active','inactive'])->default('active'); 
            $table->string('url')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_c_m_s');
    }
};

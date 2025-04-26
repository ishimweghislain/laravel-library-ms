<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('published_books')->nullable(); // JSON array of book IDs
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
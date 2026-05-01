<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('uploaded_by')->constrained('users');
            $table->string('filename');        // stored filename (hashed)
            $table->string('original_name');   // original upload name
            $table->string('mime_type', 100);
            $table->unsignedInteger('size');   // bytes
            $table->string('path', 500);       // relative path on disk
            $table->string('url', 500);        // public URL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

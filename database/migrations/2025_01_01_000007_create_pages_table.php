<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->unique(['organisation_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

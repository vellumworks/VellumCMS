<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users');
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('location', 500)->nullable();
            $table->boolean('is_online')->default(false);
            $table->string('online_url', 500)->nullable();
            $table->string('image_url', 500)->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->timestamps();

            $table->unique(['organisation_id', 'slug']);
            $table->index(['organisation_id', 'start_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

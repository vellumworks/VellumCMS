<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', [
                'owner',       // full control, one per org
                'admin',       // manage team & settings
                'editor',      // create & edit content
                'reviewer',    // review only, cannot publish
                'publisher',   // can publish approved content
            ])->default('owner');
            $table->enum('status', ['active', 'invited', 'suspended'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('totp_secret')->nullable();          // 2FA secret (TOTP)
            $table->boolean('totp_enabled')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

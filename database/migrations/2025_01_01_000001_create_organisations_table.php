<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();                    // e.g. "age-uk-london" → subdomain
            $table->string('charity_number', 20)->nullable();   // UK Charity Commission number
            $table->enum('org_type', [
                'registered-charity',
                'nonprofit',
                'cic',
                'grassroots',
            ]);
            $table->enum('status', [
                'pending',      // awaiting manual review
                'verified',     // approved (auto or manual)
                'rejected',     // declined
                'suspended',    // access removed post-approval
            ])->default('pending');
            $table->string('custom_domain')->nullable()->unique(); // e.g. www.mycharity.org.uk
            $table->json('settings')->nullable();                  // future: theme, locale, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};

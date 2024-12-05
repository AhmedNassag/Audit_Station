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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('app_store')->nullable();
            $table->string('google_play')->nullable();
            $table->json('head_quarters')->default('[]');
            $table->json('our_branches')->default('[]');
            $table->string('address')->nullable();
            $table->geometry('location')->nullable();
            $table->json('phones')->default('[]');
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

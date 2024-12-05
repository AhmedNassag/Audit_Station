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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedTinyInteger('type');
            $table->boolean('status')->default(false);
            $table->boolean('reached_company')->default(false);
            $table->boolean('reached_instructor')->default(false);
            $table->boolean('reached_accountant')->default(false);
            $table->boolean('reached_interviewer')->default(false);
            $table->boolean('reached_certified')->default(false);
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
            $table->string('locale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

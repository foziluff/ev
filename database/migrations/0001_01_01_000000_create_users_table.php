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
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->unique();
            $table->date('born_in')->nullable();
            $table->string('password')->nullable();
            $table->integer('gender')->nullable();
            $table->string('car_number')->nullable();
            $table->string('fcm_token')->nullable();

            $table->rememberToken();
            $table->string('image_path')->nullable();

            $table->string('role')->nullable();

            $table->timestamps();
        });

        Schema::create('phone_verify_codes', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->integer('code');
            $table->integer('tries')->default(0);
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('phone_verify_codes');
    }
};

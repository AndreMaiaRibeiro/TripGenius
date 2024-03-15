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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->string('avatar')->nullable()->default('users/default.png');
            $table->rememberToken();
            $table->timestamps();
        });

        // Add the role_id field to the existing users table
        //Schema::table('users', function (Blueprint $table) {
        //    $table->unsignedBigInteger('role_id')->nullable()->after('id');
        //});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


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
            $table->integer('userID');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('password'); // No hashing
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert static user (without hashing password)
        DB::table('users')->insert([
            [
                'userID'    => 555,
                'fname'     => 'Dodge',
                'lname'     => 'Suico',
                'email'     => 'dodge@gmail.com',
                'password'  => bcrypt('12345'), // Plain text password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'userID'    => 666,
                'fname'     => 'Lannes',
                'lname'     => 'Flores',
                'email'     => 'lannes@gmail.com',
                'password'  => bcrypt('12345'), // Plain text password
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

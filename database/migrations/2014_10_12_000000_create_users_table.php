<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('users', function (Blueprint $table) {
            $table->id();
          $table->uuid('uid')->unique();
        
            $table->tinyInteger('role')->comment('0-associate,1-admin,2-designer');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('email_verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->string('rera_no')->nullable();
            $table->string('team')->nullable();



            $table->string('phone');
            $table->integer('otp')->nullable();
            $table->integer('otp_verify_at')->nullable();
            $table->timestamp('otp_expire_time')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1)->comment('0-disable,1-enable');
            $table->rememberToken();
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

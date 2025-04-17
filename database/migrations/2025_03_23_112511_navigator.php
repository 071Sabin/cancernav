<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navigator', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('navigatorId')->unique();
            $table->integer('hospitalId');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('profile_pic')->nullable();
            $table->boolean('active')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
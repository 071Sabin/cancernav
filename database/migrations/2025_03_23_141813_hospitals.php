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
        Schema::create('hospital', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hospitalId')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('city');
            $table->string('state');
            $table->string('address');
            $table->string('contact_no');
            $table->string('established')->nullable();
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
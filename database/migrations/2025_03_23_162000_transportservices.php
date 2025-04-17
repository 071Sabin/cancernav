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
        Schema::create('transport_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('admin_id');
            $table->string('city');
            $table->integer('availability');
            $table->integer('num_wheelchairs')->default(0);
            $table->integer('num_caregivers')->default(0);
            $table->string('providerurl')->nullable();
            $table->string('apiurl')->nullable();
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
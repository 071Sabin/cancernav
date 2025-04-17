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
        Schema::create('broadcast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('adminId');
            $table->integer('navigatorId');
            $table->string('broadcast_title');
            $table->string('broadcast_type'); // primary, rgent will be of different color each
            $table->string('for'); //either customer or driver
            $table->string('message');
            $table->string('link')->nullable();
            $table->string('linkname')->nullable();
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
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
        Schema::create('all_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('navigator_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();

            $table->string('subject');
            $table->string('category');

            $table->enum('request_type', ['a2n', 'n2a', 'p2n']);
            $table->text('message');


            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->boolean('seen_by_recipient')->default(false);
            $table->text('response_message')->nullable();

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
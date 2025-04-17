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
        Schema::create('financialaid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // Provider Name
            $table->text('description')->nullable(); // Brief description
            $table->string('contact')->nullable(); // Phone number
            $table->string('email')->nullable(); // Email address
            $table->json('service_area')->nullable(); // States/Regions covered
            $table->enum('provider_type', ['Government', 'Non-Profit', 'Private'])->default('Non-Profit');
            $table->json('funding_source')->nullable(); // Donation, Government, etc.
            $table->decimal('max_assistance_amount', 10, 2)->nullable(); // Max financial aid in usd provided per person
            $table->text('eligibility_summary')->nullable(); // Who qualifies
            $table->text('application_process')->nullable(); // Steps to apply
            $table->json('support_languages')->nullable(); // Supported languages
            $table->string('hours_of_operation')->nullable(); // Office hours
            $table->json('social_media_links')->nullable(); // Facebook, Twitter, etc.
            $table->json('ratings_reviews')->nullable(); // User ratings & reviews
            $table->string('logo')->nullable(); // Provider Logo (File path)
            $table->string('apiurl')->nullable(); // Provider Logo (File path)
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
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
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hospitalid'); // Hospital Id to create cancer type that it currently operates on
            $table->string('name')->unique(); // Diagnosis name (e.g., Breast Cancer)
            $table->text('description')->nullable(); // Optional detailed description
            $table->string('icd_code')->nullable()->unique(); // ICD (International Classification of Diseases) code
            $table->text('treatment_guidelines')->nullable(); // Suggested treatment plan
            $table->timestamps(); // Created_at & Updated_at timestamps
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
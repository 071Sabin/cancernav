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
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hospitalId');
            $table->integer('navigatorId');
            $table->string('patientId')->unique();
            $table->string('caseId')->unique();
            $table->string('doctorname');
            $table->string('name');
            $table->string('gender');
            $table->date('dateofbirth');
            $table->string('ssn')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('cancer_type');
            $table->json('treatment_stage')->nullable();
            $table->string('insurance_status');
            $table->string('employment_status');
            $table->boolean('treatment_closed')->default(false);
            $table->timestamp('treatment_closed_at')->nullable();

            $table->string('insuranceProvider');
            $table->string('insurance_policy_number');
            $table->string('yearly_income');
            $table->string('income_source');
            $table->string('emergency_contact');
            $table->string('profile_pic')->nullable();
            $table->string('bank_statements');
            $table->string('government_id');
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
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
        Schema::create('bookingstatus', function (Blueprint $table) {


            $table->string('pickup_location')->nullable(); // Where transport picks up patient
            $table->string('dropoff_location')->nullable(); // Destination
            $table->timestamp('pickup_time')->nullable(); // Scheduled time for pickup
            $table->integer('num_wheelchairs')->default(0); // Wheelchair count
            $table->integer('num_caregivers')->default(0); // Caregiver count

            // Financial Aid Details
            $table->decimal('aid_amount', 10, 2)->nullable(); // Amount granted
            $table->text('aid_purpose')->nullable(); // Purpose (e.g., treatment, transportation)
            $table->timestamp('aid_granted_on')->nullable(); // when did aidgrant


            $table->integer('stay_duration')->nullable(); // Number of nights booked
            $table->string('room_type')->nullable(); // Single, Shared, etc.

            $table->enum('status', ['pending', 'confirmed', 'used', 'canceled', 'rejected'])->default('pending'); // Booking status

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');

    }
};
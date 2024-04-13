<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('ride_attempt')->default(0)->nullable();
            $table->string('distance_unit')->nullable();
            $table->unsignedBigInteger('riderequest_in_driver_id')->nullable();
            $table->dateTime('riderequest_in_datetime')->nullable();
            $table->string('start_latitude')->nullable();
            $table->string('start_longitude')->nullable();
            $table->text('start_address')->nullable();
            $table->string('end_latitude')->nullable();
            $table->string('end_longitude')->nullable();
            $table->text('end_address')->nullable();
            $table->double('distance')->nullable();
            $table->double('base_distance')->nullable();
            $table->double('duration')->nullable();
            $table->text('reason')->nullable();
            $table->string('status', 20)->default('active');
            // $table->double('minimum_fare')->nullable();
            // $table->double('per_distance')->nullable();
            // $table->double('per_distance_charge')->nullable();
            // $table->double('per_minute_drive')->nullable();
            // $table->double('per_minute_drive_charge')->nullable();
            $table->string('otp')->nullable();
            $table->enum('cancel_by', ['customer', 'driver', 'auto'])->nullable();
            $table->double('waiting_time')->nullable();
            $table->double('waiting_time_limit')->nullable();
            $table->double('per_minute_waiting')->nullable();
            $table->text('cancelled_driver_ids')->nullable();
            $table->double('max_time_for_find_driver_for_ride_request')->nullable();
            $table->boolean('is_ride_for_other')->default(0)->nullable()->comment('0-self, 1-other');
            $table->json('other_rider_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ride_requests');
    }
};

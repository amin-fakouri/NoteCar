<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('our_cars', function (Blueprint $table) {
            $table->id();
            //            این نشان میدهد که کدام یووزر این پست را ثبت کرده است
            $table->foreignId('submitted_by')->constrained('users')->cascadeOnDelete();
            $table->string('identification_number');
            $table->string('plat_number');
            $table->string('model');

            $table->string('promise_number');
            $table->string('profit');
            $table->string('loss');
            $table->string('cylinder_type');

            $table->string('seller');
            $table->string('mobile_seller');
            $table->string('buyer');
            $table->string('mobile_buyer');

            $table->string('color');
            $table->string('car_name');
            $table->string('gearbox_type');
            $table->string('description', 9999);
            $table->string('car_fuel_type');
            $table->string('gear_type');
            $table->string('price_car');
            $table->string('created_post');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_cars');
    }
};

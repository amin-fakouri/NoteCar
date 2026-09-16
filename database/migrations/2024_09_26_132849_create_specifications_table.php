<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();

            // کاربری که این پست را ثبت کرده است
            $table->foreignId('submitted_by')->constrained('users')->cascadeOnDelete();

            // شماره شاسی ماشین
            $table->string('identification_number');
            $table->string('plat_number');
            $table->string('model');

            $table->string('promise_number');
            //            $table->string('profit')->default(0);
            //            $table->string('loss')->default(0);
            $table->string('cylinder_type');

            $table->string('seller');
            $table->string('mobile_seller');
            $table->string('buyer')->nullable();
            $table->string('mobile_buyer')->nullable();

            $table->string('color');
            $table->string('car_name');
            $table->string('gearbox_type');
            $table->text('description');
            $table->string('car_fuel_type');
            $table->string('gear_type');
            $table->string('price_car');
            $table->string('created_post');
            $table->string('situation_mode');
            $table->string('mileage');

            // کاربری که آخرین بار این رکورد را ویرایش کرده
            $table->string('edited_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('images');

            // کاربری که این رکورد را حذف کرده (soft delete)
            $table->string('deleted_by')->nullable()->constrained('users')->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};

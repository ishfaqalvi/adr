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
        Schema::create('chemicals', function (Blueprint $table) {
            $table->id();
            $table->string('un_number')->nullable();
            $table->text('name_en')->nullable();
            $table->text('name_it')->nullable();
            $table->string('class')->nullable();
            $table->string('classification_code')->nullable();
            $table->string('packing_group')->nullable();
            $table->string('label')->nullable();
            $table->string('special_provisions')->nullable();
            $table->string('limited')->nullable();
            $table->string('expected_quantities')->nullable();
            $table->string('packing_instruction')->nullable();
            $table->string('special_packing_provision')->nullable();
            $table->string('mixed_packing_provision')->nullable();
            $table->string('instructions')->nullable();
            $table->string('p_tank_special_provisions')->nullable();
            $table->string('tank_code')->nullable();
            $table->string('ard_special_provisions')->nullable();
            $table->string('vehicle_for_tank_carriage')->nullable();
            $table->string('trc_transport_category')->nullable();
            $table->string('packages')->nullable();
            $table->string('bulk')->nullable();
            $table->string('loading_unloading_handling')->nullable();
            $table->string('operation')->nullable();
            $table->string('hazard_identification_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemicals');
    }
};

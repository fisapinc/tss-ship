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
        Schema::create('vhf_entries', function (Blueprint $table) {
            $table->id();
            $table->string('mmsi_number');
            $table->string('vessel_name');
            $table->string('vessel_type');
            $table->string('call_sign');
            $table->string('imo_number');
            $table->string('imo_classes');
            $table->string('draught');
            $table->string('air_draught');
            $table->string('total_person_onboard');
            $table->string('flag');
            $table->string('date_arrival');
            $table->string('time_arrival');
            $table->string('entry_sector');
            $table->boolean('direction');
            $table->string('position');
            $table->string('port_destination');
            $table->string('speed');
            $table->string('course');
            $table->string('hazardous_cargo');
            $table->string('quantity');
            $table->string('description');
            $table->string('comments');
            $table->string('rule_10');
            $table->string('vessel_email');
            $table->string('internal_remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vhf_entries');
    }
};

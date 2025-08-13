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
        Schema::table('historicals', function (Blueprint $table) {
            $table->foreignId('reporting_method_id')
                  ->nullable()
                  ->constrained('reporting_methods')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historicals', function (Blueprint $table) {
            //
        });
    }
};

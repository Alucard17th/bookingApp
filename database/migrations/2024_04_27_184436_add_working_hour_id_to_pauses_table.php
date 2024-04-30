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
        Schema::table('pauses', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('working_hour_id');
            $table->foreign('working_hour_id')->references('id')->on('working_hours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pauses', function (Blueprint $table) {
            //
        });
    }
};

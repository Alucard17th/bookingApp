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
        Schema::table('working_hours', function (Blueprint $table) {
            //
            $table->time('start_hour')->nullable()->change();
            $table->time('end_hour')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('working_hours', function (Blueprint $table) {
            //
        });
    }
};

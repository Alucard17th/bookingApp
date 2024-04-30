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
            $table->dropForeign(['working_hour_id']); // Drop the foreign key constraint first
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

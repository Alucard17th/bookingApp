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
        // // Drop the foreign key constraint
        // Schema::table('availabilities', function (Blueprint $table) {
        //     $table->dropForeign(['event_id']);
        // });

        // // Add new service_id field
        // Schema::table('availabilities', function (Blueprint $table) {
        //     $table->unsignedBigInteger('service_id')->nullable();
        // });

        // // Copy data from event_id to service_id
        // \DB::table('availabilities')->update(['service_id' => \DB::raw('event_id')]);

        // // Remove the event_id field
        // Schema::table('availabilities', function (Blueprint $table) {
        //     $table->dropColumn('event_id');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // // Add back the event_id field
        // Schema::table('availabilities', function (Blueprint $table) {
        //     $table->unsignedBigInteger('event_id')->nullable();
        // });

        // // Remove the service_id field
        // Schema::table('availabilities', function (Blueprint $table) {
        //     $table->dropColumn('event_id');
        // });
    }
};

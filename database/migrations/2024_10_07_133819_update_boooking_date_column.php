<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    DB::statement("ALTER TABLE bookings MODIFY COLUMN boooking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
}

public function down(): void
{
    DB::statement("ALTER TABLE bookings MODIFY COLUMN boooking_date TIMESTAMP DEFAULT NULL");
}
};

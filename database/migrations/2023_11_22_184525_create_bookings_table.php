<?php

use App\Models\Trip;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Trip::class)->constrained('trips')->onDelete('cascade');

            $table->string('seat_number');

            $table->foreignId('from')->constrained('cities')->onDelete('cascade');

            $table->foreignId('to')->constrained('cities')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

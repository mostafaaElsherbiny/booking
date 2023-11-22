<?php

use App\Models\City;
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
        Schema::create('trip_stations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trip_id')->constrained()->onDelete('cascade');


            $table->foreignIdFor(City::class, 'from')->constrained(
                'cities',
                'id'
            )->onDelete('cascade');



            $table->foreignIdFor(City::class, 'to')->constrained(
                'cities',
                'id'
            )->onDelete('cascade');


            $table->unsignedInteger('order');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_stations');
    }
};

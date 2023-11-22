<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Trip;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{

    public $model = Trip::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'time' => new DateTime($this->faker->time),
        ];
    }


    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Trip $trip) {

            $cities = City::factory()->count(2)->create();

            $trip->stations()->createMany([
                [
                    'trip_id' => $trip->id,
                    'from' => $cities[0]->id,
                    'to' => $cities[1]->id,
                    'order' => 1,
                    'seats_limit' => 12,
                ],
                [
                    'trip_id' => $trip->id,
                    'from' => $cities[1]->id,
                    'to' => $cities[0]->id,
                    'order' => 2,
                    'seats_limit' => 12,
                ],
            ]);
        });
    }
}

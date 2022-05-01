<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Room;
use App\Models\Orders;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Property::factory(50)->create()->each(function ($property) {
            Room::factory(rand(15, 45))->create([
                'property_id' => $property->id
            ])->each(function ($room) {
                Orders::factory(rand(20, 200))->create([
                    'room_id' => $room->id
                ]);
            });
        });
    }
}

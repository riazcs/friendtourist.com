<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amenities')->insert([
            [
                'name' => 'Bathroom Facilities',
                'type' => 2,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Bedroom Facilities',
                'type' => 2,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Food & Drink',
                'type' => 2,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Media & Technology',
                'type' => 2,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Bathrobes',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Bathroom',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Bathtub',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Hairdryer',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'HotTub',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Hot Water',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Hydromassage Bath',
                'type' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Air Conditioning',
                'type' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Balcony',
                'type' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Fan',
                'type' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Connecting Rooms',
                'type' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Con on Demand',
                'type' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'In-Room Safe',
                'type' => 2,
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Coffee/Tea Maker',
                'type' => 2,
                'parent_id' => 3,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Condiment',
                'type' => 2,
                'parent_id' => 3,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Fast Food',
                'type' => 2,
                'parent_id' => 3,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Free Bottled water',
                'type' => 2,
                'parent_id' => 3,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Mini Fridge',
                'type' => 2,
                'parent_id' => 3,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Cable TV',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'CD Player',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'DVD Player',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Internet',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Movies',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Radio',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'name' => 'Sound System',
                'type' => 2,
                'parent_id' => 4,
                'created_at' => now(),
                'updated_at' => now()

            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//        DB::table('users')->insert([
//            'name' => "Admin",
//            'email' => "admin@friendtourist.com",
//            'user_type' => User::Roles['Admin'],
//            "password" => bcrypt("aaaaaaaa"),
//            "phone_verified_at" => date("Y-m-d H:i:s"),
//            "email_verified_at" => date("Y-m-d H:i:s"),
//        ]);

        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@admin.com",
            'user_type' => User::Roles['Admin'],
            "password" => bcrypt("aaaaaaaa"),
            "phone_verified_at" => date("Y-m-d H:i:s"),
            "email_verified_at" => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
            'name' => "Hotel Admin",
            'email' => "admin@hotel.com",
            'user_type' => User::Roles['Hotel Admin'],
            "password" => bcrypt("aaaaaaaa"),
            "nid" => 12345,
            "dob" => time(),
            "designation" => "owner",
            "phone_verified_at" => date("Y-m-d H:i:s"),
            "email_verified_at" => date("Y-m-d H:i:s"),
        ]);

        DB::table('hotels')->insert([
            'name' => "Royal Palace",
            'license' => "12345",
            'status' => 1,
            "district_id" => 33,
            "user_id" => 2
        ]);


        DB::table('countries')->insert([
            'name' => "Bangladesh",
            'status' => 1,
        ]);
        $sql_path = base_path('database/raw_sql/districts.sql');
        $sql_path1 = base_path('database/raw_sql/division.sql');

        DB::unprepared(file_get_contents($sql_path));
        DB::unprepared(file_get_contents($sql_path1));

        $this->call([
            AmenitiesSeeder::class,
            SettingsSeeder::class,
        ]);
    }
}

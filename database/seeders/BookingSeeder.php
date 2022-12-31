<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Provider\Address;
use Illuminate\Support\Facades\DB;
class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,5) as $value){
            DB::table('booking')->insert([
                'zip_code' => $faker->randomFloat(),
                'service_type' => $faker->randomFloat(5),
                'model' => $faker->randomFloat(5),
                'device_issue' => $faker->json(),
                'screen_color' => $faker->name(),
                'warrenty' => $faker->name(),
                'screen_protector' => $faker->name(),
                'charger_cable' => $faker->date(),
                'date' => $faker->date(),
                'time' => $faker->name(),
                'address' => $faker->date(),
                'unit_floor' => $faker->date(),
                'name' => $faker->name(),
                'phone' => $faker->name(),
                'email' => $faker->name(),
                'total_price' => $faker->name(),
                
                
            ]);
        }
    }
}

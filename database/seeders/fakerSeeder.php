<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use Faker\Factory;
require_once 'vendor/autoload.php';
class fakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   $faker = Factory::create();
        for($i = 1; $i < 500; $i++) {

            DB::table('ab_user')->insert([

                'ab_name' => $faker->name(),
                'ab_password' => $faker->password(),
                'ab_email' => $faker->unique()->email]);
        }
    }
}

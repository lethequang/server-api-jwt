<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

		$limit = 60;

		for ($i = 0; $i < $limit; $i++) {
			DB::table('users')->insert([
				'full_name' => $faker->name,
				'email' => $faker->unique()->email,
				'phone' => $faker->phoneNumber,
				'password' => $faker->password
			]);
		}
    }
}

<?php

use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
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
			DB::table('invoices')->insert([
				'title' => $faker->text,
			]);
		}
    }
}

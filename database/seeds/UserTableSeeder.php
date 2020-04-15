<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 100; $i++):
            DB::table('users')
                ->insert([
                    'name' => $faker->name,
                    'email' => Str::random(10) . '@gmail.com',
                    'password' => Hash::make('password'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
        endfor;
    }
}

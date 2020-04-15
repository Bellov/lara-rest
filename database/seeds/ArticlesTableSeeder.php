<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
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
            DB::table('articles')
                ->insert([
                    'title' => $faker->sentence,
                    'body' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'publish_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                    'user_id' => User::all()->random()->id,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
        endfor;

    }
}

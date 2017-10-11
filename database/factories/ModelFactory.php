<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Employee::class, function (Faker\Generator $faker) {
    
            return [
                'name' => $faker->name,
                'start_work' => $faker->date,
                // 'salary' => 10000,
                // 'position_id' => 1,
                // 'pid' => 0,
            ];
});

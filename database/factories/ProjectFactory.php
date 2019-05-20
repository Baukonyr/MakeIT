<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->bs,
        'description' => $faker->text(),
        'status' => $faker->randomElement(['planned', 
																						'running', 
																						'on hold', 
																						'finished', 
																						'cancel']),
    ];
});

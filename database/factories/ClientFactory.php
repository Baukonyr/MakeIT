<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        //
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'email' => $faker->safeEmail,
				'password' => bcrypt($faker->password),
    ];
});

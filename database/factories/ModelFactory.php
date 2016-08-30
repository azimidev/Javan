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

$factory->define(Javan\User::class, function(Faker\Generator $faker) {
	return [
		'name'           => $faker->name,
		'role'           => 'manager',
		'email'          => $faker->safeEmail,
		'password'       => bcrypt('password'),
		'active'         => $faker->boolean($chanceOfGettingTrue = 50),
		'address'        => $faker->streetAddress,
		'city'           => $faker->city,
		'post_code'      => $faker->postcode,
		'phone'          => $faker->phoneNumber,
		'remember_token' => str_random(10),
	];
});

$factory->define(Javan\Reservation::class, function(Faker\Generator $faker) {
	return [
		'user_id' => function() {
			return factory(Javan\User::class)->create()->id;
		},
		'start'   => $faker->dateTime,
		'end'     => $faker->dateTime,
		'seats'   => $faker->numberBetween(1, 4),
		'active'  => $faker->boolean($chanceOfGettingTrue = 90),
	];
});

$factory->define(Javan\Post::class, function(Faker\Generator $faker) {
	return [
		'user_id' => function() {
			return factory(Javan\User::class)->create()->id;
		},
		'slug'    => str_slug($faker->sentence),
		'subject' => $faker->sentence,
		'body'    => $faker->paragraph(1, TRUE),
		'visible' => $faker->boolean($chanceOfGettingTrue = 90),
	];
});

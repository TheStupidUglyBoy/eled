<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->firstName,
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'user_type' =>  $faker->randomElement(['internal', 'external']),
        'role_id' => 1 , 
        'is_active' => 1 ,
        'email_verified_at' => now(),
        'password' => 'asdf1234', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,2),
        'is_active' => 1 ,
        'title' => $faker->sentence(5,15),
        'slug' => $faker->sentence(5,15),
        'description' => $faker->paragraphs(rand(10,20),true),
    ];
});

$factory->define(App\Tip::class, function (Faker $faker) {
    return [
        'question' => $faker->sentence(5,15),
        'answer' => $faker->paragraphs(rand(10,20),true),
    ];
});

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5,15),
        'slug' => $faker->sentence(5,15),
        'user_id' => $faker->numberBetween(1,2),
        'body' => $faker->paragraphs(rand(10,20),true),
    ];
});


$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name' => 'superadmin',
    ];
});

<?php

use Faker\Generator as Faker;
use Faker\Provider\Address;
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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'user_id' => 130,
        'contact_email' => 'frank@test.com',
        'contact_phone' => $faker->phoneNumber,
        'logo' => $faker->imageUrl('https://randomuser.me/api/portraits/men/43.jpg'),
        'contact_addr1' => $faker->streetAddress,
        'contact_addr2' => $faker->streetAddress,
        'contact_city' => $faker->city,
        'contact_state' => 'CA',
        'contact_zip' => Address::postcode() ,
    ];
});

$factory->define(App\Models\Menu::class, function (Faker $faker) {
    return [
        'text' => 'Sub Menu Item',
        'url' => 'some_url',
        'icon' => 'some_icon',
        'index' => 0,
    ];
});

$factory->define(App\Models\MenuSub::class, function (Faker $faker) {
    return [
        'menu_id' => 0,
        'text' => 'Sub Menu Item',
        'url' => 'some_url',
        'icon' => 'some_icon',
        'index' => 0,
    ];
});
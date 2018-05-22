<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'titre' => $faker->sentence(rand(4,8)), 
        'contenu' => $faker->paragraph(rand(5,10)),
    ];
});

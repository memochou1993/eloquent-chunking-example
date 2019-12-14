<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => sprintf('%s (%u)', $faker->sentence(), rand()),
        'author' => sprintf('%s (%u)', $faker->name(), rand()),
    ];
});

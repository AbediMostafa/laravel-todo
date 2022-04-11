<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \AbediMostafa\ToDo\http\Models\Label;
use \Illuminate\Support\Str;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'labedl'=>Str::random(10)
    ];
});

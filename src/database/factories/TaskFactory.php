<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use \Illuminate\Support\Str;
use \AbediMostafa\ToDo\http\Models\Task;
use \App\User;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title'=>Str::random(10),
        'description'=>Str::random(40),
        'status'=>$faker->randomKey(['open', 'close']),
        'user_id'=>factory(User::class),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    
    $user = factory(App\User::class)->create();

    // Make call to application...

    $this->assertDeleted($user);
});

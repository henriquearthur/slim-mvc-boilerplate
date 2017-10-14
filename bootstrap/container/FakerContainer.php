<?php

$container['faker'] = function ($c) {
    $faker = Faker\Factory::create();

    return $faker;
};

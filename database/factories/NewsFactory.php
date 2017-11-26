<?php
use Faker\Generator as Faker;

$factory->define(App\Models\News::class, function (Faker $faker) {
    $companies = ['multiplat', 'microsoft', 'nintendo', 'sony', 'pc'];
    $company = $companies[round(rand(0, 4))];
    return [
        'user_id' => 1,
        'title' => $faker->realText(rand(10, 60)),
        'description' => rand(0, 3) > 2 ? $faker->realText(rand(10, 60)) : '',
        'link' => $faker->url(),
        'company' => $company,
        'is_big_news' => rand(0, 8) > 7,
        'is_news' => $faker->boolean(),
        'is_media' => $faker->boolean(),
        'is_impressions' => $faker->boolean(),
        'is_editorial' => $faker->boolean(),
        'clicks' => $faker->randomNumber(2),
        'created_at' => date('Y-m-d H:i:s', rand(time()-60*60*24*7, time()))
    ];
});

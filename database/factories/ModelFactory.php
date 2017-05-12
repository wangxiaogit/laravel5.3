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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'status'         => true,
        'confirm_code'   => str_random(64),
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10)
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => 0,
        'path' => $faker->url
    ];
});

$factory->define(App\Article::class, function(Faker\Generator $faker) {
    $user_ids = App\User::pluck('id')->random();
    $category_ids = \App\Category::pluck('id')->random();
    $title = $faker->sentence(mt_rand(3,10));
    return [
        'user_id'      => $user_ids,
        'category_id'  => $category_ids,
        'last_user_id' => $user_ids,
        'slug'     => str_slug($title),
        'title'    => $title,
        'subtitle' => strtolower($title),
        'content'  => $faker->paragraph,
        'page_image'       => $faker->imageUrl(),
        'meta_description' => $faker->sentence,
        'is_draft'         => false,
        'published_at'     => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now')
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'tag'                => $faker->word,
        'title'              => $faker->sentence,
        'meta_description' => $faker->sentence,
    ];
});

$factory->define(App\Discussion::class, function (Faker\Generator $faker) {
    $user_ids = App\User::pluck('id')->random();
    return [
        'user_id'      => $user_ids,
        'last_user_id' => $user_ids,
        'title'        => $faker->sentence,
        'content'      => $faker->paragraph,
        'status'       => true
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $user_id = App\User::pluck('id')->random();
    $discussion_id = App\Discussion::pluck('id')->random();
    $article_id = App\Article::pluck('id')->random();

    $types = ['discussions', 'articles'];
    $commentable_type = $types[mt_rand(0, 1)];

    return [
        'user_id' => $user_id,
        'commentable_type' => $commentable_type,
        'commentable_id' => $commentable_type ? $discussion_id : $article_id,
        'content' =>$faker->paragraph
    ];
});

<?php
return [
    // Default Avatar
    'default_avatar' => env('DEFAULT_AVATAR') ?: '/images/default.png',

    // Default Icon
    'default_icon' => env('DEFAULT_ICON') ?: '/images/favicon.ico',

    // Meta
    'meta' => [
        'keywords' => 'WX Blog, blog, laravel, vuejs',
        'description' => 'Nothing is impossible in WX Blog'
    ],

    // Article Page
    'article' => [
        'title'       => 'Nothing is impossible.',
        'description' => 'https://laraving.com',
        'number'      => 15,
        'sort'        => 'desc',
        'sortColumn'  => 'published_at',
    ],

    'license' => "Powered By Jiajian Chan.<br/>This article is licensed under a <a rel='license' href='http://creativecommons.org/licenses/by-nc/4.0/'>Creative Commons Attribution-NonCommercial 4.0 International License</a>.",
];
<?php

namespace App\Providers;

use App\Article;
use App\Discussion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $lang= config('app.locale') == 'zh_cn' ? 'zh': config('app.locale');

        Carbon::setLocale($lang);

        Relation::morphMap([
            'articles'    => Article::class,
            'discussions' => Discussion::class
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Comment;
use App\Models\CommentSetting;
use App\Models\User;
use App\Models\Observers\CommentObserver;
use App\Models\Observers\CommentSettingObserver;
use App\Models\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Comment::observe(CommentObserver::class);
        CommentSetting::observe(CommentSettingObserver::class);
        User::observe(UserObserver::class);
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

<?php

namespace App\Providers;

use App\Alerts\Alert;
use App\Models\Comment;
use App\Models\CommentSetting;
use App\Models\Observers\CommentObserver;
use App\Models\Observers\CommentSettingObserver;
use App\Models\Observers\UserObserver;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::share('alert', app(Alert::class));
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

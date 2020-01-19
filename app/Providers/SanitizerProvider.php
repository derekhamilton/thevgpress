<?php

namespace App\Providers;

use App\Contracts\Html\Sanitizer;
use App\Html\Sanitizers\HtmlPurifier;
use Illuminate\Support\ServiceProvider;

class SanitizerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Sanitizer::class, function ($app) {
            return $app->make(HtmlPurifier::class);
        });
    }
}

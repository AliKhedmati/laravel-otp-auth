<?php

namespace Alikhedmati\Otp;

use Alikhedmati\Otp\Contracts\OtpInterface;
use Illuminate\Support\ServiceProvider;

class OtpServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . 'lang', 'otp');

        $this->offerPublishing();
    }

    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/config/otp.php'   =>   config_path('otp.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/lang'    =>  $this->app->langPath('vendor/otp')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/otp.php', 'otp');

        $this->app->bind(OtpInterface::class, fn() => new Otp());
    }
}
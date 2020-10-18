<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Contracts\Source\Mail\MailBoxContract',
            'App\Contracts\Source\Mail\Gmail\GmailBoxContract'
        );

        $this->app->bind(
            'App\Contracts\Repositories\Mail\MailRepositoryContract',
            'App\Contracts\Repositories\Mail\Mysql\MailRepository'
        );

        // $this->app->bind(
        //     'App\Contracts\Repositories\MailBox\MailBoxContract',
        //     'App\Contracts\Repositories\MailBox\Mysql\GmailBoxContract',
        // );
    }
}

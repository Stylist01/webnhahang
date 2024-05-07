<?php

namespace App\Providers;

use App\Model\Company;
use App\Model\Policy;
use Illuminate\Support\Facades\View;
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
        View::composer('layouts.app', function ($view) {
            return $view->with([
                'company' => Company::first(),
                'policies' => Policy::all(),
            ]);
        });
    }
}

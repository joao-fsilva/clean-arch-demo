<?php

namespace App\Providers;

use App\Repository\CustomerRepositoryEloquent;
use Demo\Domain\Repository\CustomerRepository;
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
        $this->app->singleton(
            CustomerRepository::class,
            CustomerRepositoryEloquent::class
        );
    }
}

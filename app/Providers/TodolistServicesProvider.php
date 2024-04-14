<?php

namespace App\Providers;

use App\Services\Impl\TodolistServicesImpl;
use App\Services\TodolistServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServicesProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodolistServices::class => TodolistServicesImpl::class,
    ];

    public function provides(): array
    {
        return [TodolistServices::class];
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

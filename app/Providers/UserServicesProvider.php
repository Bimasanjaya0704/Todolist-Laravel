<?php

namespace App\Providers;

use App\Services\Impl\UserServicesImpl;
use App\Services\UserServices;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServicesProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UserServices::class => UserServicesImpl::class,
    ];

    public function provides(): array{
        return [UserServices::class];
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

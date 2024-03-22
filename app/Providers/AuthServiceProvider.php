<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Passport::tokensCan([
            'super_admin' => 'super admin',
            'admin' => 'admin',
            'agent' => ' agent',
            'developer' => 'developer',
            'user' => 'user',
        ]);

        Passport::setDefaultScope([
            'user',
        ]);

        Passport::tokensExpireIn(now()->addHour(2));
        Passport::personalAccessTokensExpireIn(now()->addHour(2));
    }
}

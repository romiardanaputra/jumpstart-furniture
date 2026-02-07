<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Illuminate\Support\Facades\View::addLocation(resource_path('views/features'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        // Fortify Custom View Paths
        \Laravel\Fortify\Fortify::loginView(function () {
            return view('features.auth.login');
        });

        \Laravel\Fortify\Fortify::registerView(function () {
            return view('features.auth.register');
        });

        \Laravel\Fortify\Fortify::verifyEmailView(function () {
            return view('features.auth.verify-email');
        });

        \Laravel\Fortify\Fortify::resetPasswordView(function ($request) {
            return view('features.auth.reset-password', ['request' => $request]);
        });

        \Laravel\Fortify\Fortify::requestPasswordResetLinkView(function () {
            return view('features.auth.forgot-password');
        });

        \Laravel\Fortify\Fortify::confirmPasswordView(function () {
            return view('features.auth.confirm-password');
        });

        \Laravel\Fortify\Fortify::twoFactorChallengeView(function () {
            return view('features.auth.two-factor-challenge');
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}

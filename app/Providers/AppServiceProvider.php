<?php

namespace App\Providers;

use App\Models\BebekForm;
use App\Models\LohusaForm;
use App\Policies\BebekFormPolicy;
use App\Policies\LohusaFormPolicy;
use App\Support\MedicalFormOptions;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(LohusaForm::class, LohusaFormPolicy::class);
        Gate::policy(BebekForm::class, BebekFormPolicy::class);

        Gate::before(fn ($user, string $ability) => $user->hasRole('admin') ? true : null);
        Gate::define('viewDashboard', fn ($user) => $user->can('view dashboard'));

        Paginator::useBootstrapFive();

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::share('clinicalDefaults', MedicalFormOptions::clinicalDefaults());
    }
}

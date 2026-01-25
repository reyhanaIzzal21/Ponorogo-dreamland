<?php

namespace App\Providers;

use App\Contracts\Interfaces\MenuCategoryRepositoryInterface;
use App\Contracts\Interfaces\MenuItemRepositoryInterface;
use App\Contracts\Interfaces\MenuPriceGroupRepositoryInterface;
use App\Contracts\Interfaces\DestinationRepositoryInterface;
use App\Contracts\Interfaces\LandingPageSectionRepositoryInterface;
use App\Contracts\Interfaces\LandingPageImageRepositoryInterface;
use App\Contracts\Repositories\MenuCategoryRepository;
use App\Contracts\Repositories\MenuItemRepository;
use App\Contracts\Repositories\MenuPriceGroupRepository;
use App\Contracts\Repositories\DestinationRepository;
use App\Contracts\Repositories\LandingPageSectionRepository;
use App\Contracts\Repositories\LandingPageImageRepository;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Menu Repository Bindings
        $this->app->bind(
            MenuCategoryRepositoryInterface::class,
            MenuCategoryRepository::class
        );

        $this->app->bind(
            MenuItemRepositoryInterface::class,
            MenuItemRepository::class
        );

        $this->app->bind(
            MenuPriceGroupRepositoryInterface::class,
            MenuPriceGroupRepository::class
        );

        // Destination Repository Binding
        $this->app->bind(
            DestinationRepositoryInterface::class,
            DestinationRepository::class
        );

        // Landing Page Repository Bindings
        $this->app->bind(
            LandingPageSectionRepositoryInterface::class,
            LandingPageSectionRepository::class
        );

        $this->app->bind(
            LandingPageImageRepositoryInterface::class,
            LandingPageImageRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        // if (app()->environment('local')) {
        //     URL::forceScheme('https');
        // }
    }

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(
            fn(): ?Password => app()->isProduction()
                ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
                : null
        );
    }
}

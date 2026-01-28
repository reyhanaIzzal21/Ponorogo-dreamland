<?php

namespace App\Providers;

use App\Contracts\Interfaces\MenuCategoryRepositoryInterface;
use App\Contracts\Interfaces\MenuItemRepositoryInterface;
use App\Contracts\Interfaces\MenuPriceGroupRepositoryInterface;
use App\Contracts\Interfaces\DestinationRepositoryInterface;
use App\Contracts\Interfaces\LandingPageSectionRepositoryInterface;
use App\Contracts\Interfaces\LandingPageImageRepositoryInterface;
use App\Contracts\Interfaces\PoolRepositoryInterface;
use App\Contracts\Repositories\PoolRepository;
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

        // Restaurant Page Repository Bindings
        $this->app->bind(
            \App\Contracts\Interfaces\RestaurantSectionRepositoryInterface::class,
            \App\Contracts\Repositories\RestaurantSectionRepository::class
        );

        $this->app->bind(
            \App\Contracts\Interfaces\RestaurantGalleryImageRepositoryInterface::class,
            \App\Contracts\Repositories\RestaurantGalleryImageRepository::class
        );

        $this->app->bind(
            \App\Contracts\Interfaces\RestaurantBestSellerRepositoryInterface::class,
            \App\Contracts\Repositories\RestaurantBestSellerRepository::class
        );

        // Pavilion Page Repository Bindings
        $this->app->bind(
            \App\Contracts\Interfaces\PavilionSectionRepositoryInterface::class,
            \App\Contracts\Repositories\PavilionSectionRepository::class
        );

        $this->app->bind(
            \App\Contracts\Interfaces\PavilionFacilityRepositoryInterface::class,
            \App\Contracts\Repositories\PavilionFacilityRepository::class
        );

        $this->app->bind(
            \App\Contracts\Interfaces\PavilionLayoutRepositoryInterface::class,
            \App\Contracts\Repositories\PavilionLayoutRepository::class
        );

        $this->app->bind(
            \App\Contracts\Interfaces\AboutPageRepositoryInterface::class,
            \App\Contracts\Repositories\AboutPageRepository::class
        );

        $this->app->bind(
            PoolRepositoryInterface::class,
            PoolRepository::class
        );

        $this->app->bind(
            \App\Contracts\Interfaces\ReservationRepositoryInterface::class,
            \App\Contracts\Repositories\ReservationRepository::class
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

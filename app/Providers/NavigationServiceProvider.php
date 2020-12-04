<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Links\LinksIndexController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OriginalsController;
use App\Http\Controllers\SpeakingController;
use App\Http\Controllers\UsesController;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Link;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Menu::macro('primary', function () {
            return Menu::new()
                ->action(HomeController::class, 'Home')
                ->action(OriginalsController::class, 'Originals')
                ->action(LinksIndexController::class, 'Community')
                ->add(Link::to(action(NewsletterController::class), 'Newsletter')->addParentClass('mt-4'))

                ->action(SpeakingController::class, 'Speaking')
                ->url('about', 'About')
                ->setActiveFromRequest();
        });

        Menu::macro('secondary', function () {
            return Menu::new()
                ->url('search', 'Search')
                /*
                ->url('laravel-package-training-contest', 'Package training contest')
                ->url('mailcoach-contest', 'Mailcoach contest')
                ->url('ohdear-contest', 'Oh Dear contest')
                */
                ->action(UsesController::class, 'Uses')
                ->url('advertising', 'Advertising')

                ->setActiveFromRequest('/');
        });
    }
}

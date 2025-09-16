<?php

namespace Blumewas\LaravelLocaleFallbacks;

use Blumewas\LaravelLocaleFallbacks\Translator\LocaleFallbackTranslator;
use Illuminate\Contracts\Translation\Translator as TranslatorContract;
use Illuminate\Translation\TranslationServiceProvider;

class LaravelLocaleFallbacksServiceProvider extends TranslationServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        // Load the configuration file
        $this->publishes([
            __DIR__.'/../config/locale-fallbacks.php' => config_path('locale-fallbacks.php'),
        ], 'laravel-locale-fallbacks-config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/locale-fallbacks.php', 'locale-fallbacks'
        );

        $this->registerLoader();

        // Register the LocaleFallbackTranslator as the translator
        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];
            $locale = $app['config']['app.locale'];

            $translator = new LocaleFallbackTranslator($loader, $locale);

            return $translator;
        });

        // Bind the translator contract to the LocaleFallbackTranslator
        $this->app->bind(TranslatorContract::class, function ($app) {
            return $app['translator'];
        });
    }
}

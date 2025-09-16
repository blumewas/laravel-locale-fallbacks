<?php

use Blumewas\LaravelLocaleFallbacks\Facades\LaravelLocaleFallbacks;
use Blumewas\LaravelLocaleFallbacks\Translator\LocaleFallbackTranslator;

beforeEach(function () {
    // Set up the application environment for testing

    // Load locale files
    app('translator')->addLines([
        'messages.welcome' => 'Welcome',
    ], 'en');
});

it('replaces the default translator', function () {
    $translator = app('translator');

    expect($translator)->toBeInstanceOf(LocaleFallbackTranslator::class);
});

it('resolves the correct fallbacks for locales', function () {
    config(['locale-fallbacks.fallbacks' => [
        'en' => 'fr',
        'fr' => 'de',
        'de' => null,
    ]]);

    $frFallbacks = LaravelLocaleFallbacks::composeFallbackChainForLocale('fr');
    expect($frFallbacks)->toBe(['fr', 'de']);

    $enFallbacks = LaravelLocaleFallbacks::composeFallbackChainForLocale('en');
    expect($enFallbacks)->toBe(['en', 'fr', 'de']);
});

it('fallsback to two-letter codes when configured', function () {
    config(['locale-fallbacks.auto_fallback_two_letter_codes' => true]);

    $fallbacks = LaravelLocaleFallbacks::composeFallbackChainForLocale('en-US');
    expect($fallbacks)->toBe(['en-US', 'en']);
});

it('resolves the current locale correctly', function () {
    app()->setLocale('en');

    expect(app()->getLocale())->toBe('en');

    expect(__('messages.welcome'))->toBe('Welcome');
});

it('falls back to the correct locale', function () {
    config(['locale-fallbacks.fallbacks' => [
        'de' => 'fr',
        'fr' => 'en',
    ]]);

    app()->setLocale('fr');

    expect(__('messages.welcome'))->toBe('Welcome'); // Fallback to 'en'
});

it('returns the key if no translation is found', function () {
    app()->setLocale('de');

    expect(__('messages.non_existent_key'))->toBe('messages.non_existent_key');
});

it('handles multiple fallbacks correctly', function () {
    config(['locale-fallbacks.fallbacks' => [
        'de' => ['fr', 'en'],
    ]]);

    app()->setLocale('de');

    expect(__('messages.welcome'))->toBe('Welcome'); // Direct translation
    expect(__('messages.non_existent_key'))->toBe('messages.non_existent_key'); // No fallback found
});

it('returns the composed localization if translation is found', function () {
    config(['locale-fallbacks.fallbacks' => [
        'de' => 'fr',
        'fr' => 'en',
    ]]);

    app()->setLocale('de');

    app('translator')->addLines([
        'messages.welcome_2' => 'Willkommen',
    ], 'de');
    app('translator')->addLines([
        'messages.welcome_2' => 'Bienvenue',
    ], 'fr');
    app('translator')->addLines([
        'messages.welcome_2' => 'Welcome',
    ], 'en');

    expect(__('messages.welcome_2'))->toBe('Willkommen'); // Fallback to 'fr' then 'en
    expect(__('messages.welcome'))->toBe('Welcome'); // Direct translation
});

it('returns the two-letter code fallback when configured', function () {
    config([
        'locale-fallbacks.auto_fallback_two_letter_codes' => true,
        'locale-fallbacks.fallbacks' => [
            'de' => 'en',
        ],
    ]);

    $fallbacks = LaravelLocaleFallbacks::composeFallbackChainForLocale('de-DE');
    expect($fallbacks)->toBe(['de-DE', 'de', 'en']);

    app()->setLocale('de-DE');

    app('translator')->addLines([
        'messages.welcome' => 'Willkommen',
    ], 'de');

    expect(__('messages.welcome'))->toBe('Willkommen'); // Fallback to 'de'
});

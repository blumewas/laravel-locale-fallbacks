<?php

// config for Blumewas/LaravelLocaleFallbacks
return [

    /**
     * Define the fallback chain for each locale.
     * The keys are the locale codes, and the values are arrays of fallback locales.
     * For example, if 'de' falls back to 'en', you would set:
     * 'de' => ['en'].
     * This means that if a translation is not found in 'de', it will look for
     * the translation in 'en'.
     * You can define multiple fallbacks for a locale.
     * For example, 'de' => ['en', 'fr'] means it will first
     * try 'en', and if not found, it will try 'fr'.
     * A fallback chain is also composed. E.g. if 'de' falls back to 'en',
     * and 'de-DE' falls back to 'de', we will first try 'de-DE',
     * then 'de', and finally 'en'. This would be equivalent to:
     * 'de-DE' => ['de', 'en'],
     * 'de' => ['en'].
     */
    'fallbacks' => [
        'de' => ['en'],
    ],

    /**
     * Whether to automatically add two-letter language codes as fallbacks.
     * This is useful for apps that have regional variations of languages
     * (e.g., 'en-US' and 'en-GB') and want to ensure that
     * the two-letter code ('en') is always available as a fallback.
     */
    'autofallback_two_letter_codes' => true,
];

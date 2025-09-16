<?php

namespace Blumewas\LaravelLocaleFallbacks;

class LaravelLocaleFallbacks
{
    /**
     * The locale fallbacks.
     *
     * @var string[]
     */
    protected $localeFallbacks;

    /**
     * Indicates whether to automatically fallback to two-letter codes.
     *
     * @var bool
     */
    protected $autoFallbackTwoLetterCodes;

    public function __construct()
    {
        $this->localeFallbacks = config('locale-fallbacks.fallbacks', []);
        $this->autoFallbackTwoLetterCodes = config('locale-fallbacks.auto_fallback_two_letter_codes', true);
    }

    /**
     * Compose the fallback locales for a given locale.
     *
     * @return string[] An array of fallback locales in order to be used
     */
    public function composeFallbackChainForLocale(string $locale): array
    {
        $fallbacks = [$locale];

        // Start with the current locale
        $lastLocale = $locale;

        while ($lastLocale !== null) {
            $localeFallbacks = $this->getFallbacksForLocale($lastLocale);

            if (empty($localeFallbacks)) {
                // If no fallbacks are defined, break the loop
                break;
            }

            if (is_string($localeFallbacks)) {
                // If the fallback is a string, it means it's a single fallback locale
                $fallbacks[] = $localeFallbacks;
                $lastLocale = $localeFallbacks;

                continue;
            }

            // If the fallback is an array, merge it into the fallbacks
            foreach ($localeFallbacks as $fallbackLocale) {
                if (! in_array($fallbackLocale, $fallbacks, true)) {
                    $fallbacks[] = $fallbackLocale;
                }
            }

            // Get the next fallback locale, which is the last element in the current fallbacks
            $lastLocale = end($fallbacks);
        }

        return $fallbacks;
    }

    /**
     * Get the fallbacks for a specific locale.
     *
     * @return string|string[] An array of fallback locales
     */
    protected function getFallbacksForLocale(string $locale): array|string
    {
        if (strlen($locale) > 2 && $this->autoFallbackTwoLetterCodes) {
            // If the locale is longer than 2 characters and auto fallback is enabled,
            // we can try to fallback to the two-letter code version of the locale.
            return substr($locale, 0, 2);
        }

        return $this->localeFallbacks[$locale] ?? [];
    }
}

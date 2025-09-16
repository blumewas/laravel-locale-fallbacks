<?php

namespace Blumewas\LaravelLocaleFallbacks\Translator;

use Blumewas\LaravelLocaleFallbacks\Facades\LaravelLocaleFallbacks;
use Illuminate\Translation\Translator as BaseTranslator;

class LocaleFallbackTranslator extends BaseTranslator
{
    /**
     * The locale fallbacks.
     *
     * @var array
     */
    protected $fallbacks;

    /**
     * Indicates whether to automatically fallback to two-letter codes.
     *
     * @var bool
     */
    protected $autoFallbackTwoLetterCodes;

    public function __construct($loader, $locale)
    {
        parent::__construct($loader, $locale);

        // Config fallbacks
        $this->fallbacks = config('locale-fallbacks.fallbacks', []);
        $this->autoFallbackTwoLetterCodes = config('locale-fallbacks.auto_fallback_two_letter_codes', true);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, array $replace = [], $locale = null, $fallback = true)
    {
        $locale = $locale ?: $this->locale;

        // Get the fallback chain for the current locale
        $fallbacks = LaravelLocaleFallbacks::composeFallbackChainForLocale($locale);

        // iterate through chain: first is current locale, then others
        foreach ($fallbacks as $loc) {
            $line = parent::get($key, $replace, $loc, false);
            if ($line !== $key) {
                return $line;
            }
        }

        // as a last resort, maybe try the default fallback_locale
        if ($fallback && $this->fallback !== $locale) {
            $line = parent::get($key, $replace, $fallback, false);
            if ($line !== $key) {
                return $line;
            }
        }

        // if everything fails, return the key
        return $key;
    }
}

<?php

if (!function_exists('trans')) {
    /**
     * Get translation for a key
     */
    function trans($key, $languageCode = null)
    {
        // Get current language from session
        $session = \Config\Services::session();
        $languageCode = $languageCode ?: $session->get('language') ?: 'en';
        
        // Try to get from cache first
        $cache = \Config\Services::cache();
        $cacheKey = "translations_{$languageCode}";
        
        $translations = $cache->get($cacheKey);
        
        if (!$translations) {
            // Load from database
            $translationModel = new \App\Models\TranslationModel();
            $translations = $translationModel->getAllTranslations($languageCode);
            
            // Cache for 1 hour
            $cache->save($cacheKey, $translations, 3600);
        }
        
        // Return translation or key if not found
        return $translations[$key] ?? $key;
    }
}

if (!function_exists('current_lang')) {
    /**
     * Get current language code
     */
    function current_lang()
    {
        $session = \Config\Services::session();
        return $session->get('language') ?: 'en';
    }
}

if (!function_exists('available_languages')) {
    /**
     * Get all available languages
     */
    function available_languages()
    {
        $cache = \Config\Services::cache();
        $languages = $cache->get('available_languages');
        
        if (!$languages) {
            $languageModel = new \App\Models\LanguageModel();
            $languages = $languageModel->getActiveLanguages();
            $cache->save('available_languages', $languages, 3600);
        }
        
        return $languages;
    }
}
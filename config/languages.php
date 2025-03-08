<?php
/**
 * Configuration des langues pour le site F&P Digital Consulting
 */

return [
    // Langue par défaut
    'default' => 'fr',
    
    // Langues disponibles
    'available' => [
        'fr' => [
            'code' => 'fr',
            'name' => 'Français',
            'locale' => 'fr_FR.UTF-8',
            'date_format' => '%d %B %Y',
            'flag' => 'flag-fr',
            'url' => '/',
        ],
        'en' => [
            'code' => 'en',
            'name' => 'English',
            'locale' => 'en_US.UTF-8',
            'date_format' => '%B %d, %Y',
            'flag' => 'flag-en',
            'url' => '/en/',
        ],
        'es' => [
            'code' => 'es',
            'name' => 'Español',
            'locale' => 'es_ES.UTF-8',
            'date_format' => '%d de %B de %Y',
            'flag' => 'flag-es',
            'url' => '/es/',
        ],
    ],
    
    // Mappages entre codes de langue et URLs
    'url_mapping' => [
        'fr' => '/',
        'en' => '/en/',
        'es' => '/es/',
    ],
];

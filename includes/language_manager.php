<?php
/**
 * Gestionnaire de langues pour le site F&P Digital Consulting
 * Cette classe gère le chargement et l'utilisation des traductions dans le site.
 */
class LanguageManager {
    /**
     * Code de la langue actuelle
     * @var string
     */
    private $currentLang;
    
    /**
     * Données de configuration des langues
     * @var array
     */
    private $config;
    
    /**
     * Traductions de la langue actuelle
     * @var array
     */
    private $translations;
    
    /**
     * Constructeur
     */
    public function __construct() {
        // Charger la configuration des langues
        $this->config = include_once __DIR__ . '/../config/languages.php';
        
        // Déterminer la langue actuelle (paramètre URL, cookie, navigateur ou par défaut)
        $this->setCurrentLanguage();
        
        // Charger les traductions pour la langue actuelle
        $this->loadTranslations();
        
        // Configurer la locale pour la date/heure
        $this->configureLocale();
    }
    
    /**
     * Détermine la langue actuelle en fonction des paramètres et préférences
     */
    private function setCurrentLanguage() {
        // Par défaut, utiliser la langue configurée comme défaut
        $language = $this->config['default'];
        
        // Vérifier si une langue est spécifiée dans l'URL
        if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $this->config['available'])) {
            $language = $_GET['lang'];
            
            // Stocker la préférence dans un cookie pendant 30 jours
            setcookie('language', $language, time() + (86400 * 30), '/');
        }
        // Sinon, vérifier si une préférence est stockée dans un cookie
        elseif (isset($_COOKIE['language']) && array_key_exists($_COOKIE['language'], $this->config['available'])) {
            $language = $_COOKIE['language'];
        }
        // Ou analyser les préférences du navigateur
        else {
            $browserLangs = [];
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                // Extraire les codes de langue préférés du navigateur
                preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
                
                if (count($matches[1]) > 0) {
                    // Créer un tableau des préférences linguistiques du navigateur
                    $browserLangs = array_combine($matches[1], $matches[4]);
                    
                    // Remplir les valeurs de qualité manquantes avec 1
                    foreach ($browserLangs as $lang => $val) {
                        if ($val === '') $browserLangs[$lang] = 1;
                    }
                    
                    // Trier par qualité
                    arsort($browserLangs, SORT_NUMERIC);
                    
                    // Vérifier si l'une des langues préférées du navigateur est disponible
                    foreach ($browserLangs as $browserLang => $quality) {
                        $shortLang = substr($browserLang, 0, 2);
                        if (array_key_exists($shortLang, $this->config['available'])) {
                            $language = $shortLang;
                            break;
                        }
                    }
                }
            }
        }
        
        $this->currentLang = $language;
    }
    
    /**
     * Charge les traductions pour la langue courante
     */
    private function loadTranslations() {
        $translationFile = __DIR__ . '/../locales/' . $this->currentLang . '.php';
        
        if (file_exists($translationFile)) {
            $this->translations = include $translationFile;
        } else {
            // Fallback sur la langue par défaut si le fichier n'existe pas
            $this->currentLang = $this->config['default'];
            $this->translations = include __DIR__ . '/../locales/' . $this->currentLang . '.php';
        }
    }
    
    /**
     * Configure la locale pour le formatage des dates et des nombres
     */
    private function configureLocale() {
        if (isset($this->config['available'][$this->currentLang]['locale'])) {
            $locale = $this->config['available'][$this->currentLang]['locale'];
            setlocale(LC_TIME, $locale, substr($locale, 0, 5), substr($locale, 0, 2));
        }
    }
    
    /**
     * Récupère une traduction par sa clé
     * 
     * @param string $key Clé de traduction (format: 'section.subsection.key')
     * @param array $replacements Variables à remplacer dans la traduction
     * @return string La traduction ou la clé si non trouvée
     */
    public function get($key, $replacements = []) {
        $parts = explode('.', $key);
        $translation = $this->translations;
        
        // Naviguer dans le tableau de traductions
        foreach ($parts as $part) {
            if (!isset($translation[$part])) {
                return $key; // Retourner la clé si la traduction n'existe pas
            }
            $translation = $translation[$part];
        }
        
        // Si la valeur obtenue n'est pas une chaîne, retourner la clé
        if (!is_string($translation)) {
            return $key;
        }
        
        // Remplacer les variables
        if (!empty($replacements)) {
            foreach ($replacements as $placeholder => $value) {
                $translation = str_replace(':' . $placeholder, $value, $translation);
            }
        }
        
        return $translation;
    }
    
    /**
     * Génère le code HTML pour le sélecteur de langue
     * 
     * @return string Code HTML du sélecteur de langue
     */
    public function renderLanguageSelector() {
        $html = '<div class="language-dropdown">';
        
        // Langue actuelle
        $currentLangInfo = $this->config['available'][$this->currentLang];
        $html .= '<button class="language-current">';
        $html .= '<i class="fas fa-globe globe-icon"></i>';
        $html .= '<span class="language-flag ' . $currentLangInfo['flag'] . '"></span>';
        $html .= '<span class="current-language-label">' . $currentLangInfo['name'] . '</span>';
        $html .= '</button>';
        
        // Options de langue
        $html .= '<div class="language-options">';
        
        foreach ($this->config['available'] as $code => $langInfo) {
            $activeClass = ($code === $this->currentLang) ? ' active' : '';
            $html .= '<a href="' . $this->getLanguageUrl($code) . '" class="language-option' . $activeClass . '" data-lang="' . $code . '">';
            $html .= '<span class="language-flag ' . $langInfo['flag'] . '"></span>';
            $html .= '<span class="language-name">' . $langInfo['name'] . '</span>';
            $html .= '</a>';
        }
        
        $html .= '</div></div>';
        
        return $html;
    }
    
    /**
     * Génère le code HTML pour le sélecteur de langue mobile
     * 
     * @return string Code HTML du sélecteur de langue mobile
     */
    public function renderMobileLanguageSelector() {
        $html = '<div class="mobile-language-selector">';
        $html .= '<div class="language-title">' . $this->get('nav.language.title') . '</div>';
        $html .= '<div class="mobile-language-options">';
        
        foreach ($this->config['available'] as $code => $langInfo) {
            $activeClass = ($code === $this->currentLang) ? ' active' : '';
            $html .= '<a href="' . $this->getLanguageUrl($code) . '" class="mobile-language-option' . $activeClass . '" data-lang="' . $code . '">';
            $html .= '<span class="language-flag ' . $langInfo['flag'] . '"></span>';
            $html .= '<span class="language-name">' . $langInfo['name'] . '</span>';
            $html .= '</a>';
        }
        
        $html .= '</div></div>';
        
        return $html;
    }
    
    /**
     * Obtient l'URL pour une langue spécifique
     * 
     * @param string $langCode Code de la langue
     * @return string URL vers la version dans la langue spécifiée
     */
    public function getLanguageUrl($langCode) {
        if (isset($this->config['url_mapping'][$langCode])) {
            return $this->config['url_mapping'][$langCode];
        }
        
        // Fallback : ajouter le paramètre ?lang=XX à l'URL actuelle
        $url = $_SERVER['REQUEST_URI'];
        $url = preg_replace('/(\?|&)lang=[^&]*/', '', $url);
        $separator = (strpos($url, '?') !== false) ? '&' : '?';
        return $url . $separator . 'lang=' . $langCode;
    }
    
    /**
     * Obtient le code de la langue actuelle
     * 
     * @return string Code de la langue actuelle
     */
    public function getCurrentLanguage() {
        return $this->currentLang;
    }
    
    /**
     * Obtient les informations sur la langue actuelle
     * 
     * @return array Informations sur la langue actuelle
     */
    public function getCurrentLanguageInfo() {
        return $this->config['available'][$this->currentLang];
    }
    
    /**
     * Obtient le format de date pour la langue actuelle
     * 
     * @return string Format de date
     */
    public function getDateFormat() {
        return $this->config['available'][$this->currentLang]['date_format'];
    }
    
    /**
     * Formate une date selon la locale actuelle
     * 
     * @param int|string $timestamp Timestamp ou date à formater
     * @return string Date formatée
     */
    public function formatDate($timestamp = null) {
        if ($timestamp === null) {
            $timestamp = time();
        } elseif (is_string($timestamp)) {
            $timestamp = strtotime($timestamp);
        }
        
        return strftime($this->getDateFormat(), $timestamp);
    }
}

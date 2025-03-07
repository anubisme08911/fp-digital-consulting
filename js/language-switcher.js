/**
 * Script de gestion des langues pour F&P Digital Consulting
 * Gérer le changement de langue et la redirection vers les bonnes pages
 * Version améliorée avec support pour affichage flottant sur mobile
 */

document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour changer de langue
    function changeLanguage(lang) {
        // Pour GitHub Pages, utilisez la base du repo comme préfixe
        const baseUrl = '/fp-digital-consulting';
        
        // Déterminer la nouvelle URL basée sur la langue sélectionnée
        let newPath;
        
        if (lang === 'fr') {
            newPath = baseUrl + '/';
        } else {
            newPath = baseUrl + '/' + lang;
        }
        
        // Ajouter les query parameters existants s'il y en a
        if (window.location.search) {
            newPath += window.location.search;
        }
        
        // Ajouter le hash s'il y en a un (pour la navigation par ancre)
        if (window.location.hash) {
            newPath += window.location.hash;
        }
        
        // Rediriger vers la nouvelle URL
        window.location.href = newPath;
    }
    
    // Mettre à jour l'interface utilisateur pour refléter la langue actuelle
    function updateLanguageUI() {
        // Détecter la langue actuelle basée sur l'URL
        let currentLang = 'fr'; // Par défaut
        const path = window.location.pathname;
        
        if (path.includes('/en')) {
            currentLang = 'en';
        } else if (path.includes('/es')) {
            currentLang = 'es';
        }
        
        // Mettre à jour les classes actives
        const languageSelectors = document.querySelectorAll('.language-selector a');
        languageSelectors.forEach(function(selector) {
            const lang = selector.getAttribute('data-lang');
            if (lang === currentLang) {
                selector.classList.add('active');
            } else {
                selector.classList.remove('active');
            }
        });
    }
    
    // Ajouter des écouteurs d'événements pour les sélecteurs de langue
    const languageSelectors = document.querySelectorAll('.language-selector a');
    languageSelectors.forEach(function(selector) {
        selector.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            
            // Animation de transition
            this.classList.add('clicked');
            
            // Sauvegarder la langue préférée
            localStorage.setItem('preferredLanguage', lang);
            
            // Changer de langue après une courte animation
            setTimeout(function() {
                changeLanguage(lang);
            }, 300);
        });
    });
    
    // Fonction pour détecter la langue du navigateur
    function detectLanguage() {
        const userLang = navigator.language || navigator.userLanguage;
        // Ne prendre que les deux premiers caractères (fr, en, es, etc.)
        const langCode = userLang.substring(0, 2);
        
        // Ne retourner que les langues supportées
        if (['fr', 'en', 'es'].includes(langCode)) {
            return langCode;
        }
        
        return 'fr'; // Par défaut
    }
    
    // Fonction pour rediriger automatiquement l'utilisateur vers sa langue préférée
    function redirectToPreferredLanguage() {
        // Vérifier si l'utilisateur est sur la page d'accueil principale sans langue spécifiée
        const isHomePage = window.location.pathname === '/fp-digital-consulting/' || 
                          window.location.pathname === '/fp-digital-consulting/index.html';
        
        if (isHomePage) {
            const preferredLang = localStorage.getItem('preferredLanguage') || detectLanguage();
            
            // Rediriger uniquement si ce n'est pas le français (qui est la langue par défaut)
            if (preferredLang === 'en' || preferredLang === 'es') {
                changeLanguage(preferredLang);
            }
        }
    }
    
    // Sauvegarder la langue préférée dans le localStorage
    function savePreferredLanguage() {
        // Détecter la langue actuelle basée sur l'URL
        let currentLang = 'fr'; // Par défaut
        const path = window.location.pathname;
        
        if (path.includes('/en')) {
            currentLang = 'en';
        } else if (path.includes('/es')) {
            currentLang = 'es';
        }
        
        // Sauvegarder dans localStorage
        localStorage.setItem('preferredLanguage', currentLang);
    }
    
    // Fonction pour rendre le sélecteur de langue flottant sur mobile
    function setupMobileLanguageSelector() {
        const languageSelector = document.querySelector('.language-selector');
        if (!languageSelector) return; // Sortir si le sélecteur n'existe pas
        
        // Création d'un conteneur pour le sélecteur de langue flottant sur mobile
        const mobileContainer = document.createElement('div');
        mobileContainer.className = 'language-selector-container';
        
        // Vérifier si on est sur mobile
        function handleResize() {
            if (window.innerWidth <= 768) {
                // Si le sélecteur n'est pas déjà dans le conteneur mobile
                if (languageSelector.parentElement && languageSelector.parentElement.className !== 'language-selector-container') {
                    // Enlever le sélecteur de son emplacement actuel
                    const parent = languageSelector.parentElement;
                    parent.removeChild(languageSelector);
                    
                    // L'ajouter au conteneur mobile
                    mobileContainer.appendChild(languageSelector);
                    document.body.appendChild(mobileContainer);
                }
            } else {
                // Si le sélecteur est dans le conteneur mobile
                if (mobileContainer.contains(languageSelector)) {
                    // Enlever le sélecteur du conteneur mobile
                    mobileContainer.removeChild(languageSelector);
                    
                    // Le remettre à sa place originale
                    const navContainer = document.querySelector('.nav-container');
                    if (navContainer) {
                        navContainer.appendChild(languageSelector);
                    }
                    
                    // Enlever le conteneur mobile s'il est dans le document
                    if (document.body.contains(mobileContainer)) {
                        document.body.removeChild(mobileContainer);
                    }
                }
            }
        }
        
        // Exécuter au chargement et à chaque redimensionnement
        handleResize();
        window.addEventListener('resize', handleResize);
    }
    
    // Exécuter au chargement de la page
    updateLanguageUI();
    savePreferredLanguage();
    setupMobileLanguageSelector();
    
    // Exécuter seulement sur la page d'accueil principale
    const isHomePage = window.location.pathname === '/fp-digital-consulting/' || 
                       window.location.pathname === '/fp-digital-consulting/index.html';
    if (isHomePage) {
        redirectToPreferredLanguage();
    }
});

/**
 * Script de gestion des langues amélioré pour F&P Digital Consulting
 * Gère le nouveau sélecteur dropdown et l'animation des transitions
 * Détecte automatiquement la langue du navigateur
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le sélecteur de langue amélioré
    initLanguageDropdown();
    
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
        
        // Sauvegarder la langue préférée
        localStorage.setItem('preferredLanguage', lang);
        
        // Animer la transition avant de changer de page
        animatePageTransition().then(() => {
            // Rediriger vers la nouvelle URL
            window.location.href = newPath;
        });
    }
    
    // Fonction pour animer la transition de page
    function animatePageTransition() {
        return new Promise((resolve) => {
            // Créer un élément de transition
            const overlay = document.createElement('div');
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'var(--primary)';
            overlay.style.zIndex = '9999';
            overlay.style.opacity = '0';
            overlay.style.transition = 'opacity 0.3s ease';
            
            // Ajouter au DOM
            document.body.appendChild(overlay);
            
            // Forcer un reflow
            void overlay.offsetWidth;
            
            // Déclencher l'animation
            overlay.style.opacity = '0.5';
            
            // Attendre la fin de l'animation
            setTimeout(() => {
                resolve();
            }, 300);
        });
    }
    
    // Fonction pour initialiser le dropdown de langues
    function initLanguageDropdown() {
        const dropdown = document.querySelector('.language-dropdown');
        const currentButton = document.querySelector('.language-current');
        
        if (!dropdown || !currentButton) return;
        
        // Ouvrir/fermer le dropdown au clic
        currentButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle de la classe active
            dropdown.classList.toggle('active');
            
            // Effet ripple au clic
            createRippleEffect(e, this);
        });
        
        // Fermer le dropdown en cliquant ailleurs
        document.addEventListener('click', function() {
            dropdown.classList.remove('active');
        });
        
        // Empêcher la fermeture quand on clique dans le menu
        dropdown.querySelector('.language-options').addEventListener('click', function(e) {
            e.stopPropagation();
        });
        
        // Ajouter des écouteurs pour chaque option de langue
        const languageOptions = document.querySelectorAll('.language-option');
        languageOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Récupérer le code de langue
                const lang = this.getAttribute('data-lang');
                
                // Mettre à jour les classes actives visuellement
                languageOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                
                // Mettre à jour le bouton principal
                updateCurrentLanguage(lang);
                
                // Créer l'effet ripple
                createRippleEffect(e, this);
                
                // Fermer le dropdown après délai
                setTimeout(() => {
                    dropdown.classList.remove('active');
                    
                    // Changer de langue après animation
                    setTimeout(() => {
                        changeLanguage(lang);
                    }, 300);
                }, 300);
            });
        });
        
        // Setup pour mobile
        setupMobileLanguageSelector();
        
        // Mettre à jour la langue actuelle dans l'interface
        updateCurrentLanguageFromURL();
    }
    
    // Fonction pour créer l'effet ripple
    function createRippleEffect(event, element) {
        const ripple = document.createElement('span');
        ripple.className = 'ripple';
        
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = event.clientX - rect.left - size / 2 + 'px';
        ripple.style.top = event.clientY - rect.top - size / 2 + 'px';
        
        element.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
    
    // Fonction pour mettre à jour l'interface avec la langue actuelle
    function updateCurrentLanguage(lang) {
        const currentLangLabel = document.querySelector('.current-language-label');
        const currentFlag = document.querySelector('.language-current .language-flag');
        
        if (!currentLangLabel || !currentFlag) return;
        
        // Mettre à jour le drapeau
        currentFlag.className = `language-flag flag-${lang}`;
        
        // Mettre à jour le texte
        const langLabels = {
            'fr': 'Français',
            'en': 'English',
            'es': 'Español'
        };
        
        currentLangLabel.textContent = langLabels[lang] || 'Langue';
    }
    
    // Fonction pour détecter la langue actuelle basée sur l'URL
    function updateCurrentLanguageFromURL() {
        let currentLang = 'fr'; // Par défaut
        const path = window.location.pathname;
        
        if (path.includes('/en')) {
            currentLang = 'en';
        } else if (path.includes('/es')) {
            currentLang = 'es';
        }
        
        // Mettre à jour l'interface
        updateCurrentLanguage(currentLang);
        
        // Mettre à jour les classes actives
        const options = document.querySelectorAll('.language-option');
        options.forEach(option => {
            const lang = option.getAttribute('data-lang');
            if (lang === currentLang) {
                option.classList.add('active');
            } else {
                option.classList.remove('active');
            }
        });
    }
    
    // Fonction pour la version mobile du sélecteur
    function setupMobileLanguageSelector() {
        const dropdown = document.querySelector('.language-dropdown');
        if (!dropdown) return;
        
        function handleResize() {
            if (window.innerWidth <= 768) {
                // Vérifier si le conteneur mobile existe déjà
                if (!document.querySelector('.language-dropdown-container')) {
                    // Créer un conteneur pour le dropdown mobile
                    const mobileContainer = document.createElement('div');
                    mobileContainer.className = 'language-dropdown-container';
                    
                    // Déplacer le dropdown dans le conteneur mobile
                    const parent = dropdown.parentElement;
                    if (parent && parent.className !== 'language-dropdown-container') {
                        parent.removeChild(dropdown);
                        mobileContainer.appendChild(dropdown);
                        document.body.appendChild(mobileContainer);
                    }
                }
            } else {
                // Replacer le dropdown dans la navigation pour desktop
                const mobileContainer = document.querySelector('.language-dropdown-container');
                if (mobileContainer && mobileContainer.contains(dropdown)) {
                    mobileContainer.removeChild(dropdown);
                    const navContainer = document.querySelector('.nav-container');
                    if (navContainer) {
                        navContainer.appendChild(dropdown);
                    }
                    
                    // Supprimer le conteneur mobile
                    if (document.body.contains(mobileContainer)) {
                        document.body.removeChild(mobileContainer);
                    }
                }
            }
        }
        
        // Initialiser et ajouter un écouteur de redimensionnement
        handleResize();
        window.addEventListener('resize', handleResize);
    }
    
    // Fonction pour détecter la langue du navigateur
    function detectBrowserLanguage() {
        const userLang = navigator.language || navigator.userLanguage;
        const langCode = userLang.substring(0, 2).toLowerCase();
        
        // Vérifier si la langue du navigateur est supportée par le site
        if (['fr', 'en', 'es'].includes(langCode)) {
            return langCode;
        }
        
        return 'fr'; // Par défaut
    }
    
    // Fonction pour rediriger automatiquement vers la langue préférée
    function redirectToPreferredLanguage() {
        // Vérifier si c'est la première visite (aucune préférence enregistrée)
        if (!localStorage.getItem('preferredLanguage')) {
            // Utiliser la langue du navigateur
            const browserLang = detectBrowserLanguage();
            
            // Obtenir la langue actuelle de l'URL
            let currentLang = 'fr';
            const path = window.location.pathname;
            
            if (path.includes('/en')) {
                currentLang = 'en';
            } else if (path.includes('/es')) {
                currentLang = 'es';
            }
            
            // Rediriger seulement si différente de la langue du navigateur
            if (browserLang !== currentLang) {
                changeLanguage(browserLang);
            }
        } 
        // Sinon, si une préférence a déjà été enregistrée et qu'on est sur la page d'accueil
        else if (isHomePage()) {
            const preferredLang = localStorage.getItem('preferredLanguage');
            let currentLang = 'fr';
            const path = window.location.pathname;
            
            if (path.includes('/en')) {
                currentLang = 'en';
            } else if (path.includes('/es')) {
                currentLang = 'es';
            }
            
            // Rediriger seulement si différente de la langue préférée
            if (preferredLang !== currentLang) {
                changeLanguage(preferredLang);
            }
        }
    }
    
    // Vérifier si on est sur la page d'accueil
    function isHomePage() {
        const path = window.location.pathname;
        return path === '/fp-digital-consulting/' || 
               path === '/fp-digital-consulting' || 
               path === '/fp-digital-consulting/index.html' ||
               path === '/';
    }
    
    // Exécuter la redirection automatique au chargement
    redirectToPreferredLanguage();
});

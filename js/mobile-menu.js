/**
 * Gestion du menu mobile hamburger
 */

document.addEventListener('DOMContentLoaded', function() {
    // Éléments du menu mobile
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNavContainer = document.querySelector('.mobile-nav-container');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');
    const mobileLanguageOptions = document.querySelectorAll('.mobile-language-option');
    
    // Fonction pour basculer l'état du menu mobile
    function toggleMobileMenu() {
        mobileMenuToggle.classList.toggle('active');
        mobileNavContainer.classList.toggle('active');
        mobileMenuOverlay.classList.toggle('active');
        
        // Empêcher le défilement du corps quand le menu est ouvert
        if (mobileNavContainer.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }
    
    // Ajouter l'écouteur d'événement au bouton hamburger
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
    }
    
    // Fermer le menu en cliquant sur l'overlay
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', toggleMobileMenu);
    }
    
    // Fermer le menu après avoir cliqué sur un lien
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            toggleMobileMenu();
        });
    });
    
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
    
    // Gestion du changement de langue en mobile
    mobileLanguageOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Supprimer la classe active de toutes les options
            mobileLanguageOptions.forEach(opt => opt.classList.remove('active'));
            
            // Ajouter la classe active à l'option cliquée
            this.classList.add('active');
            
            // Récupérer la langue sélectionnée
            const selectedLang = this.getAttribute('data-lang');
            
            // Fermer le menu mobile
            toggleMobileMenu();
            
            // Changer de langue avec une petite temporisation
            setTimeout(() => {
                changeLanguage(selectedLang);
            }, 300);
        });
    });
    
    // Fermer le menu mobile lorsque la fenêtre est redimensionnée au-dessus du seuil mobile
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && mobileNavContainer && mobileNavContainer.classList.contains('active')) {
            toggleMobileMenu();
        }
    });
    
    // Amélioration de l'expérience utilisateur : si un utilisateur clique en dehors du menu, le fermer
    document.addEventListener('click', function(event) {
        if (mobileNavContainer && 
            mobileNavContainer.classList.contains('active') && 
            !mobileNavContainer.contains(event.target) && 
            !mobileMenuToggle.contains(event.target)) {
            toggleMobileMenu();
        }
    });
});
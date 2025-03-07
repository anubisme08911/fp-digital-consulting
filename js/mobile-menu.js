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
            
            // Logique pour changer de langue (à adapter selon votre implémentation existante)
            if (typeof switchLanguage === 'function') {
                switchLanguage(selectedLang);
            } else {
                console.log('Changement de langue vers:', selectedLang);
                // Redirection vers la version linguistique appropriée
                // window.location.href = `/${selectedLang}/`;
            }
            
            // Fermer le menu mobile
            toggleMobileMenu();
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
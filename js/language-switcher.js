/**
 * Script de gestion du changement de langue
 * F&P Digital Consulting
 */
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du dropdown de langues desktop
    const languageDropdown = document.querySelector('.language-dropdown');
    if (languageDropdown) {
        const languageButton = languageDropdown.querySelector('.language-current');
        const languageOptions = languageDropdown.querySelector('.language-options');
        
        // Afficher/masquer les options au clic sur le bouton
        languageButton.addEventListener('click', function(e) {
            e.preventDefault();
            languageOptions.classList.toggle('show');
        });
        
        // Fermer le dropdown si on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!languageDropdown.contains(e.target)) {
                languageOptions.classList.remove('show');
            }
        });
        
        // Gérer les clics sur les options de langue
        const languageLinks = languageOptions.querySelectorAll('.language-option');
        languageLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Le href est déjà configuré correctement dans le HTML généré par le serveur
                // Donc on laisse le comportement par défaut se produire (redirection)
            });
        });
    }
    
    // Gestion du sélecteur de langue mobile
    const mobileLanguageSelector = document.querySelector('.mobile-language-selector');
    if (mobileLanguageSelector) {
        const mobileLanguageLinks = mobileLanguageSelector.querySelectorAll('.mobile-language-option');
        mobileLanguageLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Même chose, laissez le comportement par défaut se produire
            });
        });
    }
});

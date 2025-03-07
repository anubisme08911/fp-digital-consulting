/**
 * Script de gestion des langues pour F&P Digital Consulting
 * Ce script gère le changement de langue et la redirection vers les bonnes pages
 */

document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour changer de langue
    function changeLanguage(lang) {
        // Obtenir le chemin actuel
        const currentPath = window.location.pathname;
        
        // Obtenir le fichier HTML actuel (ou 'index.html' par défaut)
        let currentFile = currentPath.split('/').pop();
        if (!currentFile || !currentFile.includes('.html')) {
            currentFile = 'index.html';
        }
        
        // Construire le nouveau chemin basé sur la langue sélectionnée
        let newPath;
        if (lang === 'fr') {
            newPath = '/' + currentFile;
        } else {
            newPath = '/' + lang + '/' + currentFile;
        }
        
        // Rediriger vers la nouvelle URL
        window.location.href = newPath;
    }
    
    // Ajouter des écouteurs d'événements pour les sélecteurs de langue
    const languageSelectors = document.querySelectorAll('.language-selector a');
    languageSelectors.forEach(function(selector) {
        selector.addEventListener('click', function(e) {
            e.preventDefault();
            const lang = this.getAttribute('data-lang');
            changeLanguage(lang);
        });
    });
    
    // Fonction pour détecter la langue du navigateur
    function detectLanguage() {
        const userLang = navigator.language || navigator.userLanguage;
        return userLang.substring(0, 2); // Récupère les deux premiers caractères (fr, en, es, etc.)
    }
    
    // Fonction pour rediriger automatiquement l'utilisateur vers sa langue préférée
    function redirectToPreferredLanguage() {
        // Vérifier si l'utilisateur est sur la page d'accueil principale sans langue spécifiée
        if (window.location.pathname === '/' || window.location.pathname === '/index.html') {
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
        
        if (path.startsWith('/en/')) {
            currentLang = 'en';
        } else if (path.startsWith('/es/')) {
            currentLang = 'es';
        }
        
        // Sauvegarder dans localStorage
        localStorage.setItem('preferredLanguage', currentLang);
    }
    
    // Exécuter à chaque chargement de page
    savePreferredLanguage();
    
    // Exécuter seulement sur la page d'accueil principale
    if (window.location.pathname === '/' || window.location.pathname === '/index.html') {
        redirectToPreferredLanguage();
    }
});

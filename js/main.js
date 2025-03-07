/**
 * F&P Digital Consulting - Script principal
 * Fonctionnalités interactives pour améliorer l'UX du site
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialisation des fonctionnalités
    initMobileMenu();
    initSmoothScroll();
    initAnimations();
    initActiveNavLinks();
    initBackToTop();
});

/**
 * Initialise le menu mobile (hamburger)
 */
function initMobileMenu() {
    const menuButton = document.querySelector('.mobile-menu-button');
    const navLinks = document.querySelector('.nav-links');
    
    if (menuButton) {
        menuButton.addEventListener('click', function() {
            this.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
        
        // Fermer le menu quand on clique sur un lien
        const links = navLinks.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', function() {
                menuButton.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });
    }
}

/**
 * Initialise le défilement fluide pour les liens d'ancrage
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80, // Ajustement pour tenir compte de l'en-tête fixe
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Initialise les animations au défilement
 */
function initAnimations() {
    // Animations des cartes de service
    const serviceCards = document.querySelectorAll('.service-card');
    animateOnScroll(serviceCards, 'animate-in');
    
    // Animations des étapes
    const steps = document.querySelectorAll('.step');
    animateOnScroll(steps, 'animate-in');
    
    // Animation du titre de la section
    const sectionTitles = document.querySelectorAll('.section-title');
    animateOnScroll(sectionTitles, 'animate-title');
}

/**
 * Anime les éléments lorsqu'ils deviennent visibles au défilement
 */
function animateOnScroll(elements, className) {
    if (!elements.length) return;
    
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add(className);
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        threshold: 0.2,
        rootMargin: '0px'
    });
    
    elements.forEach(el => {
        observer.observe(el);
    });
}

/**
 * Met en surbrillance le lien de navigation actif en fonction de la section visible
 */
function initActiveNavLinks() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-links a');
    
    if (!sections.length || !navLinks.length) return;
    
    window.addEventListener('scroll', () => {
        let current = '';
        const offset = 150;
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - offset;
            const sectionHeight = section.offsetHeight;
            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                current = '#' + section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === current) {
                link.classList.add('active');
            }
        });
    });
}

/**
 * Ajoute un bouton pour remonter en haut de la page
 */
function initBackToTop() {
    // Créer le bouton s'il n'existe pas déjà
    if (!document.querySelector('.back-to-top')) {
        const button = document.createElement('button');
        button.className = 'back-to-top';
        button.innerHTML = '<span>↑</span>';
        button.setAttribute('aria-label', 'Retour en haut');
        document.body.appendChild(button);
        
        // Afficher/masquer le bouton en fonction du défilement
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                button.classList.add('visible');
            } else {
                button.classList.remove('visible');
            }
        });
        
        // Action du bouton
        button.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}
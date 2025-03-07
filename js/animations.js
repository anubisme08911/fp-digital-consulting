/**
 * Animations pour F&P Digital Consulting
 * Ajoute des animations de défilement et d'autres effets visuels
 */

document.addEventListener('DOMContentLoaded', function() {
    // Ajouter la classe "fade-in" à tous les éléments qui doivent apparaître au scroll
    const elementsToAnimate = [
        '.service-card',
        '.step',
        '.section-title',
        '#about p',
        '#contact .container > div',
        '.footer-links'
    ];
    
    elementsToAnimate.forEach(selector => {
        document.querySelectorAll(selector).forEach((element, index) => {
            element.classList.add('fade-in');
            // Ajouter un délai progressif pour un effet en cascade
            element.style.transitionDelay = `${index * 0.1}s`;
        });
    });
    
    // Fonction pour vérifier si un élément est visible dans la fenêtre
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.85 &&
            rect.bottom >= 0
        );
    }
    
    // Fonction pour animer les éléments au scroll
    function animateOnScroll() {
        document.querySelectorAll('.fade-in').forEach(element => {
            if (isElementInViewport(element)) {
                element.classList.add('active');
            }
        });
    }
    
    // Exécuter une fois au chargement pour les éléments déjà visibles
    animateOnScroll();
    
    // Ajouter un écouteur d'événement pour le scroll
    window.addEventListener('scroll', animateOnScroll);
    
    // Animation des compteurs pour la section "À propos"
    function animateCounters() {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Plus la valeur est basse, plus rapide sera l'animation
        
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            
            const inc = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + inc);
                setTimeout(() => animateCounters(), 1);
            } else {
                counter.innerText = target;
            }
        });
    }
    
    // Animation des logos et images avec parallax
    function parallaxEffect() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        parallaxElements.forEach(element => {
            const speed = element.getAttribute('data-speed') || 0.5;
            const yPos = -(window.scrollY * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    }
    
    // Ajouter un écouteur d'événement pour le parallax
    window.addEventListener('scroll', parallaxEffect);
    
    // Animation de l'en-tête au défilement
    let lastScrollTop = 0;
    const header = document.querySelector('header');
    
    function animateHeader() {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        
        // Ajouter une classe "scrolled" quand la page défile
        if (scrollTop > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Animation de masquage/affichage de l'en-tête lors du défilement
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            // Défiler vers le bas
            header.style.transform = 'translateY(-100%)';
        } else {
            // Défiler vers le haut
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    }
    
    // Ajouter un écouteur d'événement pour l'animation de l'en-tête
    window.addEventListener('scroll', animateHeader);
    
    // Animation de typage pour le titre principal
    function typeEffect(element, text, speed) {
        let i = 0;
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        // Démarrer l'animation si l'élément existe
        if (element) {
            element.innerHTML = '';
            type();
        }
    }
    
    // Appliquer l'effet de typage après un court délai
    setTimeout(function() {
        const titleElement = document.querySelector('.typing-effect');
        if (titleElement) {
            const text = titleElement.getAttribute('data-text');
            typeEffect(titleElement, text, 50);
        }
    }, 1000);
    
    // Animation des boutons au survol
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animer les éléments de navigation au survol
    const navLinks = document.querySelectorAll('.nav-links a');
    
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Animation de défilement doux pour les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return; // Ignorer les liens vides
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100, // Offset pour l'en-tête fixe
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Animation des cartes de service
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.03)';
            this.style.boxShadow = '0 15px 40px rgba(0, 0, 0, 0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.05)';
        });
    });
});

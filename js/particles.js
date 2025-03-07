/**
 * Script pour l'effet de particules dans l'arrière-plan
 * Crée des particules animées pour donner un aspect moderne et dynamique
 */

document.addEventListener('DOMContentLoaded', function() {
    // Créer l'effet de particules pour la section hero
    function createParticles() {
        const heroSection = document.querySelector('.hero');
        const approachSection = document.querySelector('.approach');
        
        if (!heroSection || !approachSection) return;
        
        // Configuration des particules
        const particleConfig = {
            heroCount: 50,
            approachCount: 30,
            minSize: 3,
            maxSize: 8,
            minOpacity: 0.1,
            maxOpacity: 0.3,
            minSpeed: 0.5,
            maxSpeed: 2,
            colors: ['#fff', '#4EE1A0', '#3498db']
        };
        
        // Fonction pour générer un nombre aléatoire entre min et max
        function randomNumber(min, max) {
            return Math.random() * (max - min) + min;
        }
        
        // Fonction pour créer une particule
        function createParticle(section, isHero = true) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Propriétés de la particule
            const size = randomNumber(particleConfig.minSize, particleConfig.maxSize);
            const opacity = randomNumber(particleConfig.minOpacity, particleConfig.maxOpacity);
            const speed = randomNumber(particleConfig.minSpeed, particleConfig.maxSpeed);
            const colorIndex = Math.floor(Math.random() * particleConfig.colors.length);
            
            // Position initiale
            const posX = Math.random() * 100; // % de la largeur du parent
            const posY = Math.random() * 100; // % de la hauteur du parent
            
            // Appliquer les styles
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.opacity = opacity;
            particle.style.backgroundColor = particleConfig.colors[colorIndex];
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            
            // Ajouter la particule à la section
            section.appendChild(particle);
            
            // Animation de la particule
            let direction = {
                x: Math.random() > 0.5 ? 1 : -1,
                y: Math.random() > 0.5 ? 1 : -1
            };
            
            let animationFrame;
            
            function moveParticle() {
                const rect = particle.getBoundingClientRect();
                let left = parseFloat(particle.style.left);
                let top = parseFloat(particle.style.top);
                
                // Déplacer la particule
                left += speed * direction.x * 0.1;
                top += speed * direction.y * 0.1;
                
                // Rebondir sur les bords
                if (left <= 0 || left >= 100) {
                    direction.x *= -1;
                }
                
                if (top <= 0 || top >= 100) {
                    direction.y *= -1;
                }
                
                // Appliquer la nouvelle position
                particle.style.left = `${left}%`;
                particle.style.top = `${top}%`;
                
                // Continuer l'animation
                animationFrame = requestAnimationFrame(moveParticle);
            }
            
            // Commencer l'animation
            moveParticle();
            
            // Retourner un objet pour pouvoir arrêter l'animation si nécessaire
            return {
                element: particle,
                stopAnimation: function() {
                    cancelAnimationFrame(animationFrame);
                }
            };
        }
        
        // Créer les particules pour chaque section
        const heroParticles = [];
        const approachParticles = [];
        
        // Ajouter les particules à la section hero
        for (let i = 0; i < particleConfig.heroCount; i++) {
            heroParticles.push(createParticle(heroSection, true));
        }
        
        // Ajouter les particules à la section approach
        for (let i = 0; i < particleConfig.approachCount; i++) {
            approachParticles.push(createParticle(approachSection, false));
        }
        
        // Optimisation : arrêter les animations quand la section n'est pas visible
        function handleVisibility() {
            const heroRect = heroSection.getBoundingClientRect();
            const approachRect = approachSection.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            
            // Vérifier si la section hero est visible
            const isHeroVisible = (heroRect.bottom > 0 && heroRect.top < windowHeight);
            
            // Vérifier si la section approach est visible
            const isApproachVisible = (approachRect.bottom > 0 && approachRect.top < windowHeight);
            
            // Activer/désactiver les animations en fonction de la visibilité
            heroParticles.forEach(particle => {
                if (isHeroVisible) {
                    particle.element.style.display = 'block';
                } else {
                    particle.element.style.display = 'none';
                }
            });
            
            approachParticles.forEach(particle => {
                if (isApproachVisible) {
                    particle.element.style.display = 'block';
                } else {
                    particle.element.style.display = 'none';
                }
            });
        }
        
        // Appeler la fonction au chargement et au scroll
        handleVisibility();
        window.addEventListener('scroll', handleVisibility);
    }
    
    // Initialiser les particules
    createParticles();
    
    // Créer un effet de vague pour la section CTA
    function createWaveEffect() {
        const ctaSection = document.querySelector('.cta');
        if (!ctaSection) return;
        
        // Créer l'élément SVG pour la vague
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('class', 'wave-svg');
        svg.setAttribute('viewBox', '0 0 1200 120');
        svg.setAttribute('preserveAspectRatio', 'none');
        
        // Créer le chemin de la vague
        const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', 'M0,0 C150,40 350,0 500,30 C650,60 750,20 900,40 C1050,60 1150,20 1200,30 L1200,120 L0,120 Z');
        path.setAttribute('class', 'wave-path');
        
        // Ajouter le chemin au SVG
        svg.appendChild(path);
        
        // Insérer le SVG au début de la section CTA
        ctaSection.insertBefore(svg, ctaSection.firstChild);
        
        // Ajouter des styles CSS pour l'animation
        const style = document.createElement('style');
        style.textContent = `
            .wave-svg {
                position: absolute;
                top: -50px;
                left: 0;
                width: 100%;
                height: 50px;
                z-index: 1;
            }
            
            .wave-path {
                fill: var(--secondary);
                animation: wave 10s linear infinite;
            }
            
            @keyframes wave {
                0% {
                    transform: translateX(0);
                }
                50% {
                    transform: translateX(-50%);
                }
                100% {
                    transform: translateX(0);
                }
            }
        `;
        
        document.head.appendChild(style);
    }
    
    // Initialiser l'effet de vague
    createWaveEffect();
});

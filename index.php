<?php
// Configuration de la date et de l'heure pour la France
setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
$dateFormat = strftime('%d %B %Y');

// Inclure le script d'envoi d'emails
require_once 'includes/email-config.php';

// Vérifier si la session contient un résultat de formulaire
session_start();
$formResult = isset($_SESSION['form_result']) ? $_SESSION['form_result'] : null;

// Effacer le résultat après l'avoir récupéré pour éviter qu'il ne s'affiche à nouveau en cas de rafraîchissement
if (isset($_SESSION['form_result'])) {
    unset($_SESSION['form_result']);
}

// Définir les variables pour les messages de succès/erreur
$formSuccess = '';
$formError = '';

// Traiter le résultat du formulaire si disponible
if ($formResult) {
    if ($formResult['success']) {
        $formSuccess = $formResult['message'];
    } else {
        $formError = $formResult['message'];
    }
}

// Variables pour le formulaire (pour conserver les valeurs en cas d'erreur)
$name = $email = $phone = $subject = $message = '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F&P DIGITAL CONSULTING | Transformation Digitale</title>
    <meta name="description" content="F&P Digital Consulting vous accompagne dans chaque étape de votre transformation numérique pour répondre aux défis de demain.">
    <!-- Meta tags pour le référencement multilingue -->
    <link rel="alternate" hreflang="fr" href="https://anubisme08911.github.io/fp-digital-consulting/" />
    <link rel="alternate" hreflang="en" href="https://anubisme08911.github.io/fp-digital-consulting/en/" />
    <link rel="alternate" hreflang="es" href="https://anubisme08911.github.io/fp-digital-consulting/es/" />
    <link rel="alternate" hreflang="x-default" href="https://anubisme08911.github.io/fp-digital-consulting/" />
    <!-- Styles -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/redesigned-language-selector.css">
    <link rel="stylesheet" href="css/modern-elements.css">
    <link rel="stylesheet" href="css/overflow-fix.css">
    <link rel="stylesheet" href="css/mobile-menu.css">
    <link rel="stylesheet" href="css/contact-form.css">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">F&P <span class="highlight">DIGITAL CONSULTING</span></div>
                
                <!-- Bouton du menu hamburger pour mobile -->
                <div class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="nav-container">
                    <div class="nav-links">
                        <a href="#services" class="nav-item">Services</a>
                        <a href="#approach" class="nav-item">Notre Approche</a>
                        <a href="#about" class="nav-item">À Propos</a>
                        <a href="#contact" class="nav-item">Contact</a>
                    </div>
                    
                    <!-- Nouveau sélecteur de langue avec dropdown -->
                    <div class="language-dropdown">
                        <button class="language-current">
                            <i class="fas fa-globe globe-icon"></i>
                            <span class="language-flag flag-fr"></span>
                            <span class="current-language-label">Français</span>
                        </button>
                        <div class="language-options">
                            <a href="#" class="language-option active" data-lang="fr">
                                <span class="language-flag flag-fr"></span>
                                <span class="language-name">Français</span>
                            </a>
                            <a href="#" class="language-option" data-lang="en">
                                <span class="language-flag flag-en"></span>
                                <span class="language-name">English</span>
                            </a>
                            <a href="#" class="language-option" data-lang="es">
                                <span class="language-flag flag-es"></span>
                                <span class="language-name">Español</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Menu mobile qui apparaît sur le côté -->
    <div class="mobile-nav-container">
        <div class="mobile-nav-links">
            <a href="#services"><i class="fas fa-cogs"></i> Services</a>
            <a href="#approach"><i class="fas fa-road"></i> Notre Approche</a>
            <a href="#about"><i class="fas fa-info-circle"></i> À Propos</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
        </div>
        <div class="mobile-language-selector">
            <div class="language-title">Changer de langue</div>
            <div class="mobile-language-options">
                <a href="#" class="mobile-language-option active" data-lang="fr">
                    <span class="language-flag flag-fr"></span>
                    <span class="language-name">Français</span>
                </a>
                <a href="#" class="mobile-language-option" data-lang="en">
                    <span class="language-flag flag-en"></span>
                    <span class="language-name">English</span>
                </a>
                <a href="#" class="mobile-language-option" data-lang="es">
                    <span class="language-flag flag-es"></span>
                    <span class="language-name">Español</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Overlay qui s'affiche en arrière-plan quand le menu mobile est ouvert -->
    <div class="mobile-menu-overlay"></div>
    
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="typing-effect" data-text="Transformation Digitale pour Votre Entreprise">Transformation Digitale pour Votre Entreprise</h1>
                <p>Nous vous accompagnons dans chaque étape de votre transformation numérique pour répondre aux défis de demain.</p>
                <a href="#contact" class="btn bounce">Contactez-nous <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
    
    <section id="services">
        <div class="container">
            <h2 class="section-title">Nos Services</h2>
            <div class="services">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-cogs"></i></div>
                    <h3>Conseil Stratégique</h3>
                    <p>Élaboration de stratégies digitales sur mesure pour optimiser vos processus et développer de nouveaux modèles économiques.</p>
                    <a href="#contact" class="service-link">En savoir plus <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>Transformation Digitale</h3>
                    <p>Accompagnement complet dans la transition vers le numérique, de l'audit initial jusqu'à l'implémentation des solutions.</p>
                    <a href="#contact" class="service-link">En savoir plus <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-users"></i></div>
                    <h3>Coaching Professionnel</h3>
                    <p>Sessions de coaching personnalisées pour développer les compétences numériques de vos équipes et favoriser l'adoption des nouvelles technologies.</p>
                    <a href="#contact" class="service-link">En savoir plus <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    
    <section id="approach" class="approach">
        <div class="container">
            <h2 class="section-title" style="color: white;">Notre Approche</h2>
            <div class="steps">
                <div class="step">
                    <span class="step-number">1</span>
                    <h3>Audit</h3>
                    <p>Analyse complète de votre écosystème digital actuel et identification des opportunités d'amélioration.</p>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <h3>Stratégie</h3>
                    <p>Élaboration d'une feuille de route digitale alignée avec vos objectifs commerciaux.</p>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <h3>Implémentation</h3>
                    <p>Mise en œuvre des solutions technologiques et accompagnement au changement.</p>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <h3>Optimisation</h3>
                    <p>Suivi des performances et ajustements continus pour maximiser les résultats.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="about">
        <div class="container">
            <h2 class="section-title">À Propos de Nous</h2>
            <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="50">0</div>
                        <div class="stat-title">Projets réalisés</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="15">0</div>
                        <div class="stat-title">Experts en digital</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="98">0</div>
                        <div class="stat-title">% Satisfaction client</div>
                    </div>
                </div>
                <p style="font-size: 18px; margin-bottom: 30px;">
                    F&P DIGITAL CONSULTING est une société spécialisée dans l'accompagnement des entreprises face aux défis de la transition numérique. Nous combinons expertise technique et vision stratégique pour vous aider à tirer parti des opportunités offertes par la digitalisation.
                </p>
                <p style="font-size: 18px;">
                    Notre équipe d'experts est composée de professionnels passionnés par l'innovation, avec une solide expérience dans divers secteurs d'activité. Nous croyons fermement que la transformation digitale réussie repose autant sur l'humain que sur la technologie.
                </p>
            </div>
        </div>
    </section>
    
    <section class="cta">
        <div class="container">
            <h2>Prêt à Transformer Votre Entreprise?</h2>
            <p style="font-size: 18px; margin-bottom: 30px;">Contactez-nous dès aujourd'hui pour discuter de vos besoins en transformation digitale et coaching.</p>
            <a href="#contact" class="btn">Demander un Devis Gratuit <i class="fas fa-file-invoice"></i></a>
        </div>
    </section>
    
    <section id="contact">
        <div class="container">
            <h2 class="section-title">Contactez-Nous</h2>
            <div style="text-align: center; max-width: 600px; margin: 0 auto;">
                <p style="font-size: 18px; margin-bottom: 30px;">
                    Nous sommes à votre disposition pour répondre à toutes vos questions et vous accompagner dans votre transformation digitale.
                </p>
                
                <!-- Nouveau formulaire de contact -->
                <div class="contact-form-container">
                    <form id="contactForm" class="contact-form" method="post" action="includes/send-email.php">
                        <!-- Champ caché pour la langue -->
                        <input type="hidden" name="lang" value="fr">
                        
                        <!-- Messages de succès/erreur -->
                        <?php if (!empty($formSuccess)): ?>
                        <div class="form-success-message" style="display: block;"><?php echo $formSuccess; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($formError)): ?>
                        <div class="form-error-message" style="display: block;"><?php echo $formError; ?></div>
                        <?php endif; ?>
                        
                        <div id="formSuccess" class="form-success-message"></div>
                        <div id="formError" class="form-error-message"></div>
                        
                        <div class="form-group">
                            <label for="name" class="required-field">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="required-field">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre numéro de téléphone" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Sujet</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Sujet de votre message" value="<?php echo isset($subject) ? htmlspecialchars($subject) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="required-field">Message</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Votre message" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="form-submit">
                            <i class="fas fa-paper-plane"></i> Envoyer
                        </button>
                    </form>
                </div>
                
                <div class="contact-separator">
                    <span>OU</span>
                </div>
                
                <!-- Informations de contact existantes -->
                <div class="contact-box">
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-envelope"></i> Email</h3>
                        <p>contact@fpdigitalconsulting.com</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-phone"></i> Téléphone</h3>
                        <p>+34 XXX XXX XXX</p>
                    </div>
                    <div>
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-map-marker-alt"></i> Adresse</h3>
                        <p>AVENIDA NAVARRA, 20<br>08911 - Badalona<br>Espagne</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-logo">F&P <span class="highlight">DIGITAL CONSULTING</span></div>
                    <p>Votre partenaire en transformation digitale et coaching professionnel.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#services">Conseil Stratégique</a></li>
                        <li><a href="#services">Transformation Digitale</a></li>
                        <li><a href="#services">Coaching Professionnel</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Liens Utiles</h3>
                    <ul>
                        <li><a href="#about">À Propos</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#">Mentions Légales</a></li>
                    </ul>
                </div>
            </div>
            <div class="legal">
                <p>&copy; 2025 F&P DIGITAL CONSULTING S.L. Tous droits réservés. | Date : <?php echo $dateFormat; ?></p>
                <p style="margin-top: 10px;">F&P DIGITAL CONSULTING S.L. | Adresse : AVENIDA NAVARRA, 20 - 08911 - Badalona (Espagne) | NIF : B70973193 | TVA : ESB70973193</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="js/improved-language-switcher.js"></script>
    <script src="js/animations.js"></script>
    <script src="js/particles.js"></script>
    <script src="js/mobile-menu.js"></script>
    <script src="js/contact-form.js"></script>
</body>
</html>
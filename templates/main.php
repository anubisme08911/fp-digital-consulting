<?php
/**
 * Template principal du site F&P Digital Consulting
 * Ce template est utilisé pour toutes les langues, en remplaçant les textes par les traductions appropriées.
 */
?>
<!DOCTYPE html>
<html lang="<?php echo $lang->getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang->get('meta.title'); ?></title>
    <meta name="description" content="<?php echo $lang->get('meta.description'); ?>">
    
    <!-- Meta tags pour le référencement multilingue -->
    <link rel="alternate" hreflang="fr" href="https://anubisme08911.github.io/fp-digital-consulting/" />
    <link rel="alternate" hreflang="en" href="https://anubisme08911.github.io/fp-digital-consulting/en/" />
    <link rel="alternate" hreflang="es" href="https://anubisme08911.github.io/fp-digital-consulting/es/" />
    <link rel="alternate" hreflang="x-default" href="https://anubisme08911.github.io/fp-digital-consulting/" />
    
    <!-- Styles -->
    <?php if ($lang->getCurrentLanguage() === 'fr'): ?>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/redesigned-language-selector.css">
    <link rel="stylesheet" href="css/modern-elements.css">
    <link rel="stylesheet" href="css/overflow-fix.css">
    <link rel="stylesheet" href="css/mobile-menu.css">
    <link rel="stylesheet" href="css/contact-form.css">
    <?php else: ?>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/redesigned-language-selector.css">
    <link rel="stylesheet" href="../css/modern-elements.css">
    <link rel="stylesheet" href="../css/overflow-fix.css">
    <link rel="stylesheet" href="../css/mobile-menu.css">
    <link rel="stylesheet" href="../css/contact-form.css">
    <?php endif; ?>
    
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
                        <a href="#services" class="nav-item"><?php echo $lang->get('nav.services'); ?></a>
                        <a href="#approach" class="nav-item"><?php echo $lang->get('nav.approach'); ?></a>
                        <a href="#about" class="nav-item"><?php echo $lang->get('nav.about'); ?></a>
                        <a href="#contact" class="nav-item"><?php echo $lang->get('nav.contact'); ?></a>
                    </div>
                    
                    <!-- Sélecteur de langue avec dropdown -->
                    <?php echo $lang->renderLanguageSelector(); ?>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Menu mobile qui apparaît sur le côté -->
    <div class="mobile-nav-container">
        <div class="mobile-nav-links">
            <a href="#services"><i class="fas fa-cogs"></i> <?php echo $lang->get('nav.services'); ?></a>
            <a href="#approach"><i class="fas fa-road"></i> <?php echo $lang->get('nav.approach'); ?></a>
            <a href="#about"><i class="fas fa-info-circle"></i> <?php echo $lang->get('nav.about'); ?></a>
            <a href="#contact"><i class="fas fa-envelope"></i> <?php echo $lang->get('nav.contact'); ?></a>
        </div>
        
        <!-- Sélecteur de langue pour mobile -->
        <?php echo $lang->renderMobileLanguageSelector(); ?>
    </div>
    
    <!-- Overlay qui s'affiche en arrière-plan quand le menu mobile est ouvert -->
    <div class="mobile-menu-overlay"></div>
    
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="typing-effect" data-text="<?php echo $lang->get('hero.title'); ?>"><?php echo $lang->get('hero.title'); ?></h1>
                <p><?php echo $lang->get('hero.subtitle'); ?></p>
                <a href="#contact" class="btn bounce"><?php echo $lang->get('hero.cta'); ?> <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
    
    <section id="services">
        <div class="container">
            <h2 class="section-title"><?php echo $lang->get('services.title'); ?></h2>
            <div class="services">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-cogs"></i></div>
                    <h3><?php echo $lang->get('services.strategic.title'); ?></h3>
                    <p><?php echo $lang->get('services.strategic.description'); ?></p>
                    <a href="#contact" class="service-link"><?php echo $lang->get('services.learn_more'); ?> <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                    <h3><?php echo $lang->get('services.transformation.title'); ?></h3>
                    <p><?php echo $lang->get('services.transformation.description'); ?></p>
                    <a href="#contact" class="service-link"><?php echo $lang->get('services.learn_more'); ?> <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-users"></i></div>
                    <h3><?php echo $lang->get('services.coaching.title'); ?></h3>
                    <p><?php echo $lang->get('services.coaching.description'); ?></p>
                    <a href="#contact" class="service-link"><?php echo $lang->get('services.learn_more'); ?> <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    
    <section id="approach" class="approach">
        <div class="container">
            <h2 class="section-title" style="color: white;"><?php echo $lang->get('approach.title'); ?></h2>
            <div class="steps">
                <div class="step">
                    <span class="step-number">1</span>
                    <h3><?php echo $lang->get('approach.steps.1.title'); ?></h3>
                    <p><?php echo $lang->get('approach.steps.1.description'); ?></p>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <h3><?php echo $lang->get('approach.steps.2.title'); ?></h3>
                    <p><?php echo $lang->get('approach.steps.2.description'); ?></p>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <h3><?php echo $lang->get('approach.steps.3.title'); ?></h3>
                    <p><?php echo $lang->get('approach.steps.3.description'); ?></p>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <h3><?php echo $lang->get('approach.steps.4.title'); ?></h3>
                    <p><?php echo $lang->get('approach.steps.4.description'); ?></p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="about">
        <div class="container">
            <h2 class="section-title"><?php echo $lang->get('about.title'); ?></h2>
            <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="50">0</div>
                        <div class="stat-title"><?php echo $lang->get('about.stats.projects'); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="15">0</div>
                        <div class="stat-title"><?php echo $lang->get('about.stats.experts'); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="98">0</div>
                        <div class="stat-title"><?php echo $lang->get('about.stats.satisfaction'); ?></div>
                    </div>
                </div>
                <p style="font-size: 18px; margin-bottom: 30px;">
                    <?php echo $lang->get('about.paragraph1'); ?>
                </p>
                <p style="font-size: 18px;">
                    <?php echo $lang->get('about.paragraph2'); ?>
                </p>
            </div>
        </div>
    </section>
    
    <section class="cta">
        <div class="container">
            <h2><?php echo $lang->get('cta.title'); ?></h2>
            <p style="font-size: 18px; margin-bottom: 30px;"><?php echo $lang->get('cta.subtitle'); ?></p>
            <a href="#contact" class="btn"><?php echo $lang->get('cta.button'); ?> <i class="fas fa-file-invoice"></i></a>
        </div>
    </section>
    
    <section id="contact">
        <div class="container">
            <h2 class="section-title"><?php echo $lang->get('contact.title'); ?></h2>
            <div style="text-align: center; max-width: 600px; margin: 0 auto;">
                <p style="font-size: 18px; margin-bottom: 30px;">
                    <?php echo $lang->get('contact.subtitle'); ?>
                </p>
                
                <?php if ($lang->getCurrentLanguage() === 'fr'): ?>
                <!-- Formulaire de contact (uniquement en français pour l'instant) -->
                <div class="contact-form-container">
                    <form id="contactForm" class="contact-form" method="post" action="#contact">
                        <?php if (!empty($formSuccess)): ?>
                        <div class="form-success-message" style="display: block;"><?php echo $formSuccess; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($formError)): ?>
                        <div class="form-error-message" style="display: block;"><?php echo $formError; ?></div>
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="name" class="required-field"><?php echo $lang->get('contact.form.name'); ?></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="<?php echo $lang->get('contact.form.name'); ?>" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="required-field"><?php echo $lang->get('contact.form.email'); ?></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo $lang->get('contact.form.email'); ?>" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone"><?php echo $lang->get('contact.form.phone'); ?></label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="<?php echo $lang->get('contact.form.phone'); ?>" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject"><?php echo $lang->get('contact.form.subject'); ?></label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="<?php echo $lang->get('contact.form.subject'); ?>" value="<?php echo isset($subject) ? htmlspecialchars($subject) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="required-field"><?php echo $lang->get('contact.form.message'); ?></label>
                            <textarea id="message" name="message" class="form-control" placeholder="<?php echo $lang->get('contact.form.message'); ?>" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="form-submit">
                            <i class="fas fa-paper-plane"></i> <?php echo $lang->get('contact.form.submit'); ?>
                        </button>
                    </form>
                </div>
                
                <div class="contact-separator">
                    <span><?php echo $lang->get('contact.form.or'); ?></span>
                </div>
                <?php endif; ?>
                
                <!-- Informations de contact -->
                <div class="contact-box">
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-envelope"></i> <?php echo $lang->get('contact.info.email'); ?></h3>
                        <p>contact@fpdigitalconsulting.com</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-phone"></i> <?php echo $lang->get('contact.info.phone'); ?></h3>
                        <p>+34 XXX XXX XXX</p>
                    </div>
                    <div>
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-map-marker-alt"></i> <?php echo $lang->get('contact.info.address'); ?></h3>
                        <p>AVENIDA NAVARRA, 20<br>08911 - Badalona<br>
                        <?php if ($lang->getCurrentLanguage() === 'en'): ?>
                        Spain
                        <?php elseif ($lang->getCurrentLanguage() === 'es'): ?>
                        España
                        <?php else: ?>
                        Espagne
                        <?php endif; ?>
                        </p>
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
                    <p><?php echo $lang->get('footer.tagline'); ?></p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3><?php echo $lang->get('footer.services_title'); ?></h3>
                    <ul>
                        <li><a href="#services"><?php echo $lang->get('services.strategic.title'); ?></a></li>
                        <li><a href="#services"><?php echo $lang->get('services.transformation.title'); ?></a></li>
                        <li><a href="#services"><?php echo $lang->get('services.coaching.title'); ?></a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3><?php echo $lang->get('footer.links_title'); ?></h3>
                    <ul>
                        <li><a href="#about"><?php echo $lang->get('footer.useful_links.about'); ?></a></li>
                        <li><a href="#contact"><?php echo $lang->get('footer.useful_links.contact'); ?></a></li>
                        <li><a href="#"><?php echo $lang->get('footer.useful_links.legal'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="legal">
                <p><?php echo $lang->get('footer.copyright'); ?> | Date : <?php echo $lang->formatDate(); ?></p>
                <p style="margin-top: 10px;"><?php echo $lang->get('footer.legal_info'); ?></p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <?php if ($lang->getCurrentLanguage() === 'fr'): ?>
    <script src="js/improved-language-switcher.js"></script>
    <script src="js/animations.js"></script>
    <script src="js/particles.js"></script>
    <script src="js/mobile-menu.js"></script>
    <?php if (!$formSubmitted): ?>
    <script src="js/contact-form.js"></script>
    <?php endif; ?>
    <?php else: ?>
    <script src="../js/improved-language-switcher.js"></script>
    <script src="../js/animations.js"></script>
    <script src="../js/particles.js"></script>
    <script src="../js/mobile-menu.js"></script>
    <?php endif; ?>
</body>
</html>

<?php
// Configuración de la fecha y hora para español
setlocale(LC_TIME, 'es_ES.UTF8', 'es.UTF8', 'es_ES.UTF-8', 'es.UTF-8');
$dateFormat = strftime('%d de %B de %Y');

// Procesamiento del formulario de contacto (se completará más adelante)
$formSubmitted = false;
$formError = '';
$formSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Validación básica
    if (empty($name) || empty($email) || empty($message)) {
        $formError = 'Por favor, rellena todos los campos obligatorios.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = 'Por favor, introduce una dirección de correo electrónico válida.';
    } else {
        // En una implementación real, aquí se enviaría el correo electrónico
        // Ejemplo: mail('contact@fpdigitalconsulting.com', 'Nuevo mensaje del sitio web', $message, $headers);
        
        // Mensaje de éxito
        $formSuccess = 'Tu mensaje ha sido enviado con éxito. Nos pondremos en contacto contigo lo antes posible.';
        $formSubmitted = true;
        
        // Reiniciar campos
        $name = $email = $phone = $subject = $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F&P DIGITAL CONSULTING | Transformación Digital</title>
    <meta name="description" content="F&P Digital Consulting te acompaña en cada etapa de tu transformación digital para afrontar los desafíos del mañana.">
    <!-- Meta tags para SEO multilingüe -->
    <link rel="alternate" hreflang="fr" href="https://anubisme08911.github.io/fp-digital-consulting/" />
    <link rel="alternate" hreflang="en" href="https://anubisme08911.github.io/fp-digital-consulting/en/" />
    <link rel="alternate" hreflang="es" href="https://anubisme08911.github.io/fp-digital-consulting/es/" />
    <link rel="alternate" hreflang="x-default" href="https://anubisme08911.github.io/fp-digital-consulting/" />
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/redesigned-language-selector.css">
    <link rel="stylesheet" href="../css/modern-elements.css">
    <link rel="stylesheet" href="../css/overflow-fix.css">
    <link rel="stylesheet" href="../css/mobile-menu.css">
    <link rel="stylesheet" href="../css/contact-form.css">
    <!-- Font Awesome para iconos -->
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
                
                <!-- Botón hamburguesa para móvil -->
                <div class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <div class="nav-container">
                    <div class="nav-links">
                        <a href="#services" class="nav-item">Servicios</a>
                        <a href="#approach" class="nav-item">Nuestro Enfoque</a>
                        <a href="#about" class="nav-item">Nosotros</a>
                        <a href="#contact" class="nav-item">Contacto</a>
                    </div>
                    
                    <!-- Nuevo selector de idioma con desplegable -->
                    <div class="language-dropdown">
                        <button class="language-current">
                            <i class="fas fa-globe globe-icon"></i>
                            <span class="language-flag flag-es"></span>
                            <span class="current-language-label">Español</span>
                        </button>
                        <div class="language-options">
                            <a href="#" class="language-option" data-lang="fr">
                                <span class="language-flag flag-fr"></span>
                                <span class="language-name">Français</span>
                            </a>
                            <a href="#" class="language-option" data-lang="en">
                                <span class="language-flag flag-en"></span>
                                <span class="language-name">English</span>
                            </a>
                            <a href="#" class="language-option active" data-lang="es">
                                <span class="language-flag flag-es"></span>
                                <span class="language-name">Español</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    <!-- Menú móvil que aparece desde el lateral -->
    <div class="mobile-nav-container">
        <div class="mobile-nav-links">
            <a href="#services"><i class="fas fa-cogs"></i> Servicios</a>
            <a href="#approach"><i class="fas fa-road"></i> Nuestro Enfoque</a>
            <a href="#about"><i class="fas fa-info-circle"></i> Nosotros</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contacto</a>
        </div>
        <div class="mobile-language-selector">
            <div class="language-title">Cambiar Idioma</div>
            <div class="mobile-language-options">
                <a href="#" class="mobile-language-option" data-lang="fr">
                    <span class="language-flag flag-fr"></span>
                    <span class="language-name">Français</span>
                </a>
                <a href="#" class="mobile-language-option" data-lang="en">
                    <span class="language-flag flag-en"></span>
                    <span class="language-name">English</span>
                </a>
                <a href="#" class="mobile-language-option active" data-lang="es">
                    <span class="language-flag flag-es"></span>
                    <span class="language-name">Español</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Overlay que aparece detrás del menú móvil cuando está abierto -->
    <div class="mobile-menu-overlay"></div>
    
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="typing-effect" data-text="Transformación Digital para tu Empresa">Transformación Digital para tu Empresa</h1>
                <p>Te acompañamos en cada etapa de tu transformación digital para afrontar los desafíos del mañana.</p>
                <a href="#contact" class="btn bounce">Contáctanos <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
    
    <section id="services">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="services">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-cogs"></i></div>
                    <h3>Consultoría Estratégica</h3>
                    <p>Elaboración de estrategias digitales a medida para optimizar tus procesos y desarrollar nuevos modelos de negocio.</p>
                    <a href="#contact" class="service-link">Más información <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>Transformación Digital</h3>
                    <p>Acompañamiento completo en la transición hacia lo digital, desde la auditoría inicial hasta la implementación de soluciones.</p>
                    <a href="#contact" class="service-link">Más información <i class="fas fa-chevron-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-users"></i></div>
                    <h3>Coaching Profesional</h3>
                    <p>Sesiones de coaching personalizadas para desarrollar las habilidades digitales de tus equipos y fomentar la adopción de nuevas tecnologías.</p>
                    <a href="#contact" class="service-link">Más información <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    
    <section id="approach" class="approach">
        <div class="container">
            <h2 class="section-title" style="color: white;">Nuestro Enfoque</h2>
            <div class="steps">
                <div class="step">
                    <span class="step-number">1</span>
                    <h3>Auditoría</h3>
                    <p>Análisis completo de tu ecosistema digital actual e identificación de oportunidades de mejora.</p>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <h3>Estrategia</h3>
                    <p>Elaboración de una hoja de ruta digital alineada con tus objetivos comerciales.</p>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <h3>Implementación</h3>
                    <p>Puesta en marcha de soluciones tecnológicas y acompañamiento al cambio.</p>
                </div>
                <div class="step">
                    <span class="step-number">4</span>
                    <h3>Optimización</h3>
                    <p>Seguimiento del rendimiento y ajustes continuos para maximizar los resultados.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="about">
        <div class="container">
            <h2 class="section-title">Sobre Nosotros</h2>
            <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="50">0</div>
                        <div class="stat-title">Proyectos realizados</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="15">0</div>
                        <div class="stat-title">Expertos en digital</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number counter" data-target="98">0</div>
                        <div class="stat-title">% Satisfacción cliente</div>
                    </div>
                </div>
                <p style="font-size: 18px; margin-bottom: 30px;">
                    F&P DIGITAL CONSULTING es una empresa especializada en el acompañamiento de empresas frente a los desafíos de la transición digital. Combinamos experiencia técnica y visión estratégica para ayudarte a aprovechar las oportunidades que ofrece la digitalización.
                </p>
                <p style="font-size: 18px;">
                    Nuestro equipo de expertos está compuesto por profesionales apasionados por la innovación, con una sólida experiencia en diversos sectores de actividad. Creemos firmemente que la transformación digital exitosa se basa tanto en las personas como en la tecnología.
                </p>
            </div>
        </div>
    </section>
    
    <section class="cta">
        <div class="container">
            <h2>¿Listo para Transformar tu Empresa?</h2>
            <p style="font-size: 18px; margin-bottom: 30px;">Contáctanos hoy mismo para hablar de tus necesidades de transformación digital y coaching.</p>
            <a href="#contact" class="btn">Solicitar un Presupuesto Gratuito <i class="fas fa-file-invoice"></i></a>
        </div>
    </section>
    
    <section id="contact">
        <div class="container">
            <h2 class="section-title">Contáctanos</h2>
            <div style="text-align: center; max-width: 600px; margin: 0 auto;">
                <p style="font-size: 18px; margin-bottom: 30px;">
                    Estamos a tu disposición para responder a todas tus preguntas y acompañarte en tu transformación digital.
                </p>
                
                <!-- Nuevo formulario de contacto -->
                <div class="contact-form-container">
                    <form id="contactForm" class="contact-form" method="post" action="#contact">
                        <?php if (!empty($formSuccess)): ?>
                        <div class="form-success-message" style="display: block;"><?php echo $formSuccess; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($formError)): ?>
                        <div class="form-error-message" style="display: block;"><?php echo $formError; ?></div>
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="name" class="required-field">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Tu nombre" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="required-field">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Tu dirección de email" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Tu número de teléfono" value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Asunto</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Asunto de tu mensaje" value="<?php echo isset($subject) ? htmlspecialchars($subject) : ''; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="required-field">Mensaje</label>
                            <textarea id="message" name="message" class="form-control" placeholder="Tu mensaje" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="form-submit">
                            <i class="fas fa-paper-plane"></i> Enviar
                        </button>
                    </form>
                </div>
                
                <div class="contact-separator">
                    <span>O</span>
                </div>
                
                <!-- Información de contacto existente -->
                <div class="contact-box">
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-envelope"></i> Email</h3>
                        <p>contact@fpdigitalconsulting.com</p>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-phone"></i> Teléfono</h3>
                        <p>+34 XXX XXX XXX</p>
                    </div>
                    <div>
                        <h3 style="color: var(--primary); margin-bottom: 10px;"><i class="fas fa-map-marker-alt"></i> Dirección</h3>
                        <p>AVENIDA NAVARRA, 20<br>08911 - Badalona<br>España</p>
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
                    <p>Tu socio en transformación digital y coaching profesional.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Servicios</h3>
                    <ul>
                        <li><a href="#services">Consultoría Estratégica</a></li>
                        <li><a href="#services">Transformación Digital</a></li>
                        <li><a href="#services">Coaching Profesional</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Enlaces Útiles</h3>
                    <ul>
                        <li><a href="#about">Nosotros</a></li>
                        <li><a href="#contact">Contacto</a></li>
                        <li><a href="#">Aviso Legal</a></li>
                    </ul>
                </div>
            </div>
            <div class="legal">
                <p>&copy; 2025 F&P DIGITAL CONSULTING S.L. Todos los derechos reservados. | Fecha: <?php echo $dateFormat; ?></p>
                <p style="margin-top: 10px;">F&P DIGITAL CONSULTING S.L. | Dirección: AVENIDA NAVARRA, 20 - 08911 - Badalona (España) | NIF: B70973193 | IVA: ESB70973193</p>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="../js/improved-language-switcher.js"></script>
    <script src="../js/animations.js"></script>
    <script src="../js/particles.js"></script>
    <script src="../js/mobile-menu.js"></script>
    <?php if (!$formSubmitted): ?>
    <script src="../js/contact-form.js"></script>
    <?php endif; ?>
</body>
</html>
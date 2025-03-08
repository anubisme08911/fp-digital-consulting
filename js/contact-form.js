/**
 * Script pour gérer le formulaire de contact
 */
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Récupérer les données du formulaire
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const subject = document.getElementById('subject').value.trim();
            const message = document.getElementById('message').value.trim();
            
            // Déterminer la langue en fonction de l'URL
            let lang = 'fr'; // par défaut
            if (window.location.pathname.includes('/en/')) {
                lang = 'en';
            } else if (window.location.pathname.includes('/es/')) {
                lang = 'es';
            }
            
            // Textes d'état selon la langue
            const loadingTexts = {
                'fr': 'Envoi en cours...',
                'en': 'Sending...',
                'es': 'Enviando...'
            };
            
            const buttonTexts = {
                'fr': '<i class="fas fa-paper-plane"></i> Envoyer',
                'en': '<i class="fas fa-paper-plane"></i> Send',
                'es': '<i class="fas fa-paper-plane"></i> Enviar'
            };
            
            const errorMessages = {
                'fields': {
                    'fr': 'Veuillez remplir tous les champs obligatoires.',
                    'en': 'Please fill in all required fields.',
                    'es': 'Por favor, rellena todos los campos obligatorios.'
                },
                'email': {
                    'fr': 'Veuillez entrer une adresse email valide.',
                    'en': 'Please enter a valid email address.',
                    'es': 'Por favor, introduce una dirección de correo electrónico válida.'
                },
                'server': {
                    'fr': 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.',
                    'en': 'An error occurred while sending your message. Please try again later.',
                    'es': 'Se ha producido un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.'
                }
            };
            
            // Vérification basique des champs obligatoires
            if (!name || !email || !message) {
                showError(errorMessages.fields[lang]);
                return;
            }
            
            // Validation basique de l'email
            if (!isValidEmail(email)) {
                showError(errorMessages.email[lang]);
                return;
            }
            
            // Préparation des données à envoyer
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('subject', subject);
            formData.append('message', message);
            formData.append('lang', lang);
            
            // Bouton submit
            const submitButton = document.querySelector('.form-submit');
            const originalButtonText = submitButton.innerHTML;
            
            // Changer le texte du bouton pour indiquer que l'envoi est en cours
            submitButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${loadingTexts[lang]}`;
            submitButton.disabled = true;
            
            // Envoi des données via AJAX
            fetch('/includes/send-email.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Réinitialiser le formulaire en cas de succès
                if (data.success) {
                    contactForm.reset();
                    showSuccess(data.message);
                } else {
                    showError(data.message);
                }
                
                // Restaurer le bouton
                submitButton.innerHTML = buttonTexts[lang];
                submitButton.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                showError(errorMessages.server[lang]);
                
                // Restaurer le bouton
                submitButton.innerHTML = buttonTexts[lang];
                submitButton.disabled = false;
            });
        });
    }
    
    // Fonction pour valider le format de l'email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Fonction pour afficher un message d'erreur
    function showError(message) {
        const errorElement = document.getElementById('formError');
        errorElement.textContent = message;
        errorElement.style.display = 'block';
        
        // Masquer le message de succès s'il est affiché
        const successElement = document.getElementById('formSuccess');
        successElement.style.display = 'none';
        
        // Faire défiler jusqu'au message d'erreur
        errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Masquer le message après 5 secondes
        setTimeout(function() {
            errorElement.style.display = 'none';
        }, 5000);
    }
    
    // Fonction pour afficher un message de succès
    function showSuccess(message) {
        const successElement = document.getElementById('formSuccess');
        successElement.textContent = message;
        successElement.style.display = 'block';
        
        // Masquer le message d'erreur s'il est affiché
        const errorElement = document.getElementById('formError');
        errorElement.style.display = 'none';
        
        // Faire défiler jusqu'au message de succès
        successElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Masquer le message après 5 secondes
        setTimeout(function() {
            successElement.style.display = 'none';
        }, 5000);
    }
    
    // Vérifier s'il y a un résultat de formulaire dans l'URL (après une soumission par POST)
    const urlParams = new URLSearchParams(window.location.search);
    const formResult = urlParams.get('form_result');
    
    if (formResult) {
        try {
            const result = JSON.parse(decodeURIComponent(formResult));
            if (result.success) {
                showSuccess(result.message);
            } else {
                showError(result.message);
            }
        } catch (e) {
            console.error('Error parsing form result:', e);
        }
    }
});

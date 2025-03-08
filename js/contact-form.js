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
            
            // Vérification basique des champs obligatoires
            if (!name || !email || !message) {
                showError("Veuillez remplir tous les champs obligatoires.");
                return;
            }
            
            // Validation basique de l'email
            if (!isValidEmail(email)) {
                showError("Veuillez entrer une adresse email valide.");
                return;
            }
            
            // Simuler l'envoi du formulaire (à remplacer par votre logique réelle d'envoi)
            // Dans une implémentation réelle, vous utiliseriez fetch() ou XMLHttpRequest pour envoyer les données à un backend
            
            // Pour la démonstration, nous allons simuler un délai puis afficher un message de succès
            const submitButton = document.querySelector('.form-submit');
            const originalButtonText = submitButton.innerHTML;
            
            // Changer le texte du bouton pour indiquer que l'envoi est en cours
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
            submitButton.disabled = true;
            
            // Simuler un délai de traitement
            setTimeout(function() {
                // Réinitialiser le formulaire
                contactForm.reset();
                
                // Afficher le message de succès
                showSuccess("Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.");
                
                // Restaurer le bouton
                submitButton.innerHTML = originalButtonText;
                submitButton.disabled = false;
            }, 1500);
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
});
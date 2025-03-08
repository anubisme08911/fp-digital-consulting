<?php
/**
 * Point d'entrée principal du site F&P Digital Consulting
 * Ce fichier charge le gestionnaire de langue et le template commun
 */

// Initialisation des variables pour le formulaire de contact
$formSubmitted = false;
$formError = '';
$formSuccess = '';
$name = $email = $phone = $subject = $message = '';

// Traitement du formulaire de contact
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Inclusion du gestionnaire de langue pour obtenir les messages traduits
    require_once __DIR__ . '/includes/language_manager.php';
    $lang = new LanguageManager();
    
    // Validation basique
    if (empty($name) || empty($email) || empty($message)) {
        $formError = $lang->get('contact.form.error');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = $lang->get('contact.form.email_error');
    } else {
        // Dans une implémentation réelle, vous enverriez ici l'email
        // Exemple: mail('contact@fpdigitalconsulting.com', 'Nouveau message du site web', $message, $headers);
        
        // Message de succès
        $formSuccess = $lang->get('contact.form.success');
        $formSubmitted = true;
        
        // Réinitialiser les champs
        $name = $email = $phone = $subject = $message = '';
    }
} else {
    // Inclusion du gestionnaire de langue
    require_once __DIR__ . '/includes/language_manager.php';
    $lang = new LanguageManager();
}

// Inclure le template principal
require_once __DIR__ . '/templates/main.php';

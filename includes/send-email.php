<?php
/**
 * Script d'envoi d'emails pour F&P Digital Consulting
 * 
 * Ce script traite les soumissions du formulaire de contact et envoie les emails
 * à l'adresse email configurée.
 */

// Inclusion du fichier de configuration
require_once 'email-config.php';

/**
 * Fonction pour envoyer un email à partir des données du formulaire
 * 
 * @param array  $post_data  Les données POST du formulaire
 * @param string $lang       La langue utilisée (fr, en, es)
 * 
 * @return array Un tableau contenant le statut et le message
 */
function send_contact_email($post_data, $lang = 'fr') {
    // Vérification des champs obligatoires
    if (empty($post_data['name']) || empty($post_data['email']) || empty($post_data['message'])) {
        return [
            'success' => false,
            'message' => $GLOBALS['error_messages']['fields'][$lang]
        ];
    }
    
    // Vérification de l'email
    if (!filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
        return [
            'success' => false,
            'message' => $GLOBALS['error_messages']['email'][$lang]
        ];
    }
    
    // Préparation des données du formulaire
    $name = htmlspecialchars($post_data['name']);
    $email = htmlspecialchars($post_data['email']);
    $phone = !empty($post_data['phone']) ? htmlspecialchars($post_data['phone']) : 'Non renseigné';
    $subject = !empty($post_data['subject']) ? htmlspecialchars($post_data['subject']) : 'Sans objet';
    $message = htmlspecialchars($post_data['message']);
    
    // Sujet de l'email
    $email_subject = $GLOBALS['email_subjects'][$lang];
    
    // Construction du corps de l'email
    $email_body = "Nom: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Téléphone: $phone\n";
    $email_body .= "Sujet: $subject\n\n";
    $email_body .= "Message:\n$message\n";
    
    // En-têtes de l'email
    $headers = "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM . ">\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Tentative d'envoi de l'email
    $mail_sent = mail(EMAIL_TO, $email_subject, $email_body, $headers);
    
    // Retour du résultat
    if ($mail_sent) {
        return [
            'success' => true,
            'message' => $GLOBALS['success_messages'][$lang]
        ];
    } else {
        return [
            'success' => false,
            'message' => $GLOBALS['error_messages']['server'][$lang]
        ];
    }
}

/**
 * Traitement de la soumission du formulaire
 * 
 * Cette partie est exécutée uniquement si le script est appelé directement
 * via une requête AJAX ou une soumission de formulaire.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Déterminer la langue en fonction de l'URL ou du paramètre
    $lang = 'fr'; // Par défaut en français
    
    if (isset($_POST['lang'])) {
        $lang = $_POST['lang'];
    } else {
        // Détection automatique de la langue basée sur l'URL
        $url_path = $_SERVER['REQUEST_URI'];
        
        if (strpos($url_path, '/en/') !== false) {
            $lang = 'en';
        } elseif (strpos($url_path, '/es/') !== false) {
            $lang = 'es';
        }
    }
    
    // Vérification si c'est une requête AJAX
    $is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    
    // Envoi de l'email
    $result = send_contact_email($_POST, $lang);
    
    // Retour de la réponse en fonction du type de requête
    if ($is_ajax) {
        // Réponse JSON pour les requêtes AJAX
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    } else {
        // Pour les soumissions de formulaire standard, stocker le résultat dans la session
        session_start();
        $_SESSION['form_result'] = $result;
        
        // Redirection vers la page précédente avec un ancre vers le formulaire
        $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/';
        
        // Assurez-vous que l'URL contient bien l'ancre #contact
        if (strpos($redirect_url, '#contact') === false) {
            $redirect_url .= '#contact';
        }
        
        header('Location: ' . $redirect_url);
        exit;
    }
}

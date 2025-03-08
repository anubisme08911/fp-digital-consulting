<?php
/**
 * Configuration de l'envoi d'emails pour le site F&P Digital Consulting
 * 
 * Ce fichier contient les paramètres de configuration pour l'envoi d'emails
 * depuis les formulaires de contact du site.
 */

// Adresse email destinataire (où les messages seront envoyés)
define('EMAIL_TO', 'francois.kerloch@gmail.com');

// Adresse de l'expéditeur (l'adresse "from" qui apparaîtra dans les emails)
define('EMAIL_FROM', 'contact@fpdigitalconsulting.com');

// Nom de l'expéditeur qui apparaîtra dans les emails
define('EMAIL_FROM_NAME', 'F&P Digital Consulting - Formulaire de Contact');

// Configuration des sujets d'email selon la langue
$email_subjects = [
    'fr' => 'Nouveau message du formulaire de contact - F&P Digital Consulting',
    'en' => 'New message from contact form - F&P Digital Consulting',
    'es' => 'Nuevo mensaje del formulario de contacto - F&P Digital Consulting'
];

// Configuration des messages de confirmation selon la langue
$success_messages = [
    'fr' => 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.',
    'en' => 'Your message has been sent successfully. We will get back to you as soon as possible.',
    'es' => 'Tu mensaje ha sido enviado con éxito. Nos pondremos en contacto contigo lo antes posible.'
];

// Configuration des messages d'erreur selon la langue
$error_messages = [
    'fields' => [
        'fr' => 'Veuillez remplir tous les champs obligatoires.',
        'en' => 'Please fill in all required fields.',
        'es' => 'Por favor, rellena todos los campos obligatorios.'
    ],
    'email' => [
        'fr' => 'Veuillez entrer une adresse email valide.',
        'en' => 'Please enter a valid email address.',
        'es' => 'Por favor, introduce una dirección de correo electrónico válida.'
    ],
    'server' => [
        'fr' => 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer plus tard.',
        'en' => 'An error occurred while sending your message. Please try again later.',
        'es' => 'Se ha producido un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.'
    ]
];

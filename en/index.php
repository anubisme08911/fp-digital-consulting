<?php
/**
 * Point d'entrée pour la version anglaise du site
 * Force la langue à l'anglais et inclut le fichier principal
 */

// Définir manuellement la langue à l'anglais
$_GET['lang'] = 'en';

// Inclusion du fichier principal
require_once dirname(__DIR__) . '/index.php';

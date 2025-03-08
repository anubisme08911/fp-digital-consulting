<?php
/**
 * Point d'entrée pour la version espagnole du site
 * Force la langue à l'espagnol et inclut le fichier principal
 */

// Définir manuellement la langue à l'espagnol
$_GET['lang'] = 'es';

// Inclusion du fichier principal
require_once dirname(__DIR__) . '/index.php';

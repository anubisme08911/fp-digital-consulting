# Refactorisation multilingue du site F&P Digital Consulting

Cette branche contient une refactorisation du site pour une gestion multilingue centralisée.

## Structure du projet

- `/locales/` - Contient les fichiers de traduction pour chaque langue
  - `/locales/fr.php` - Traductions en français
  - `/locales/en.php` - Traductions en anglais
  - `/locales/es.php` - Traductions en espagnol
- `/templates/` - Contient les modèles de page partagés
- `/index.php` - Point d'entrée principal qui charge la langue appropriée
- `/css/`, `/js/` - Ressources partagées

## Comment ça fonctionne

1. L'utilisateur accède au site avec un paramètre de langue (ex: `?lang=en`)
2. Le système charge les traductions correspondantes
3. Le template principal est rendu avec les traductions correctes

## Avantages

- Code fonctionnel écrit une seule fois
- Maintenance simplifiée
- Cohérence garantie entre les différentes versions linguistiques

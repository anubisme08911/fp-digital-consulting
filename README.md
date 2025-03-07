# F&P Digital Consulting - Site Web Multilingue

Ce dépôt contient le code source du site web officiel de F&P Digital Consulting, une société spécialisée dans la transformation digitale et le coaching professionnel. Le site est disponible en trois langues : français (par défaut), anglais et espagnol.

## Structure du Site

Le site suit une structure de répertoires organisée par langue :

```
fp-digital-consulting/
├── index.html              # Version française (par défaut)
├── css/
│   └── styles.css          # Styles communs à toutes les versions
├── js/
│   └── language-switcher.js # Script de gestion des langues
├── en/
│   └── index.html          # Version anglaise
└── es/
    └── index.html          # Version espagnole
```

## Fonctionnalités Multilingues

Le site comprend les fonctionnalités multilingues suivantes :

1. **Sélecteur de Langue** - Un sélecteur de langue est affiché dans l'en-tête du site, permettant aux utilisateurs de basculer entre les différentes versions linguistiques.

2. **Détection Automatique de Langue** - Le site détecte automatiquement la langue préférée du navigateur de l'utilisateur et le redirige vers la version appropriée si disponible.

3. **Référencement Multilingue** - Des balises `hreflang` sont incluses dans chaque version pour informer les moteurs de recherche des alternatives linguistiques disponibles.

4. **Mémorisation de la Préférence** - La préférence linguistique de l'utilisateur est mémorisée pour les visites ultérieures grâce au stockage local.

## Comment Ajouter une Nouvelle Langue

Pour ajouter une nouvelle langue au site, suivez ces étapes :

1. **Créer un Nouveau Répertoire** - Créez un répertoire avec le code de langue à deux lettres (par exemple, `de` pour l'allemand).

2. **Copier et Traduire l'index.html** - Copiez la version française de `index.html` dans le nouveau répertoire et traduisez tout le contenu.

3. **Mettre à Jour l'Attribut lang** - Changez l'attribut `lang` dans la balise `<html>` pour refléter la nouvelle langue.

4. **Mettre à Jour les Métadonnées** - Mettez à jour les balises de titre, description et les balises `hreflang` pour inclure la nouvelle langue.

5. **Ajouter la Langue au Sélecteur** - Ajoutez la nouvelle langue au sélecteur de langue dans toutes les versions existantes.

6. **Mettre à Jour le Script Language-Switcher** - Modifiez le script pour prendre en charge la nouvelle langue si nécessaire.

## Maintenance du Contenu Multilingue

Lors de la mise à jour du contenu du site, assurez-vous de :

1. Mettre à jour chaque version linguistique avec les traductions correspondantes.
2. Conserver la cohérence de la structure HTML entre les différentes versions.
3. Tester le sélecteur de langue pour vérifier que la navigation entre les langues fonctionne correctement.

## Technologies Utilisées

- HTML5
- CSS3
- JavaScript (Vanilla)
- Stockage local pour la mémorisation des préférences

## Déploiement

Le site peut être déployé sur n'importe quel serveur web statique. Assurez-vous que la structure de répertoires reste intacte pour préserver le fonctionnement du système multilingue.

---

© 2025 F&P DIGITAL CONSULTING S.L. Tous droits réservés.

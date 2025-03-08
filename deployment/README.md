# Guide de déploiement - FP Digital Consulting

Ce dossier contient tous les fichiers nécessaires au déploiement du site web de FP Digital Consulting sur un VPS Ubuntu.

## Structure des répertoires

```
deployment/
├── nginx/               # Configurations Nginx
│   ├── fp-dc.eu.conf     # Config pour le site principal
│   └── dev.fp-dc.eu.conf # Config pour l'environnement de développement
├── scripts/             # Scripts de déploiement
│   └── deploy.sh         # Script principal de déploiement
└── ssl/                 # Certificats SSL (non inclus dans le dépôt pour des raisons de sécurité)
```

## Configuration du serveur

### Étape 1: Installation des logiciels nécessaires

```bash
# Mettre à jour le système
sudo apt update
sudo apt upgrade -y

# Installer Nginx, PHP, Git et autres outils nécessaires
sudo apt install -y nginx php8.1-fpm php8.1-cli php8.1-mysql php8.1-curl php8.1-gd php8.1-mbstring php8.1-xml php8.1-zip php8.1-fpm php8.1-bcmath git certbot python3-certbot-nginx
```

### Étape 2: Configuration des domaines

1. Créer les répertoires pour les sites

```bash
sudo mkdir -p /var/www/fp-dc.eu/production
sudo mkdir -p /var/www/fp-dc.eu/development
```

2. Configurer Nginx

```bash
# Copier les fichiers de configuration
sudo cp deployment/nginx/fp-dc.eu.conf /etc/nginx/sites-available/
sudo cp deployment/nginx/dev.fp-dc.eu.conf /etc/nginx/sites-available/

# Activer les sites
sudo ln -s /etc/nginx/sites-available/fp-dc.eu.conf /etc/nginx/sites-enabled/
sudo ln -s /etc/nginx/sites-available/dev.fp-dc.eu.conf /etc/nginx/sites-enabled/

# Vérifier la configuration
sudo nginx -t

# Redémarrer Nginx
sudo systemctl restart nginx
```

### Étape 3: Configuration des certificats SSL avec Let's Encrypt

```bash
# Obtenir un certificat SSL pour le domaine principal
sudo certbot --nginx -d fp-dc.eu -d www.fp-dc.eu

# Obtenir un certificat SSL pour le sous-domaine de développement
sudo certbot --nginx -d dev.fp-dc.eu
```

### Étape 4: Configuration du déploiement automatique

1. Copier le script de déploiement

```bash
sudo cp deployment/scripts/deploy.sh /usr/local/bin/
sudo chmod +x /usr/local/bin/deploy.sh
```

2. Exécuter le déploiement initial

```bash
sudo /usr/local/bin/deploy.sh all
```

3. Configurer un cron job pour les mises à jour automatiques (optionnel)

```bash
sudo crontab -e
```

Ajouter la ligne suivante pour une mise à jour quotidienne à 2h du matin :

```
0 2 * * * /usr/local/bin/deploy.sh all >> /var/log/fp-deploy.log 2>&1
```

## Configuration DNS chez Hostinger

Voici les enregistrements DNS à configurer dans votre panneau Hostinger :

1. Enregistrement A pour le domaine principal :
   - Type: A
   - Nom: @
   - Valeur: [IP de votre VPS OVH]
   - TTL: 3600

2. Enregistrement A pour le www :
   - Type: A
   - Nom: www
   - Valeur: [IP de votre VPS OVH]
   - TTL: 3600

3. Enregistrement A pour le sous-domaine de développement :
   - Type: A
   - Nom: dev
   - Valeur: [IP de votre VPS OVH]
   - TTL: 3600

## Création de la branche de développement

Pour créer une branche de développement à partir de la branche principale :

```bash
# Cloner le dépôt localement
git clone https://github.com/anubisme08911/fp-digital-consulting.git
cd fp-digital-consulting

# Créer la branche de développement
git checkout -b development
git push -u origin development
```

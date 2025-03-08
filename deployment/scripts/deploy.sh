#!/bin/bash

# Script de déploiement pour le site FP Digital Consulting

# Variables
PROD_DIR="/var/www/fp-dc.eu/production"
DEV_DIR="/var/www/fp-dc.eu/development"
REPO_URL="https://github.com/anubisme08911/fp-digital-consulting.git"
MAIN_BRANCH="main"
DEV_BRANCH="development"
LOG_FILE="/var/log/fp-deploy.log"

# Fonction de log
log() {
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $1" | tee -a "$LOG_FILE"
}

# Création du fichier de log s'il n'existe pas
touch "$LOG_FILE"

log "Début du déploiement"

# Déploiement production
if [ "$1" == "production" ] || [ "$1" == "all" ]; then
    log "Déploiement de la production"
    
    # Si le répertoire n'existe pas, initialiser le dépôt
    if [ ! -d "$PROD_DIR/.git" ]; then
        log "Initialisation du dépôt production"
        mkdir -p "$PROD_DIR"
        git clone -b "$MAIN_BRANCH" "$REPO_URL" "$PROD_DIR"
    else
        # Sinon, mettre à jour le dépôt existant
        log "Mise à jour du dépôt production"
        cd "$PROD_DIR" || exit
        git fetch origin
        git reset --hard "origin/$MAIN_BRANCH"
    fi
    
    log "Déploiement production terminé"
    
    # Mise à jour des permissions
    log "Mise à jour des permissions production"
    chown -R www-data:www-data "$PROD_DIR"
    find "$PROD_DIR" -type d -exec chmod 755 {} \;
    find "$PROD_DIR" -type f -exec chmod 644 {} \;
    
    # Redémarrage de Nginx
    log "Redémarrage de Nginx"
    systemctl reload nginx
fi

# Déploiement développement
if [ "$1" == "development" ] || [ "$1" == "all" ]; then
    log "Déploiement de développement"
    
    # Si le répertoire n'existe pas, initialiser le dépôt
    if [ ! -d "$DEV_DIR/.git" ]; then
        log "Initialisation du dépôt développement"
        mkdir -p "$DEV_DIR"
        git clone -b "$DEV_BRANCH" "$REPO_URL" "$DEV_DIR"
    else
        # Sinon, mettre à jour le dépôt existant
        log "Mise à jour du dépôt développement"
        cd "$DEV_DIR" || exit
        git fetch origin
        git reset --hard "origin/$DEV_BRANCH"
    fi
    
    log "Déploiement développement terminé"
    
    # Mise à jour des permissions
    log "Mise à jour des permissions développement"
    chown -R www-data:www-data "$DEV_DIR"
    find "$DEV_DIR" -type d -exec chmod 755 {} \;
    find "$DEV_DIR" -type f -exec chmod 644 {} \;
    
    # Redémarrage de Nginx
    log "Redémarrage de Nginx"
    systemctl reload nginx
fi

log "Fin du déploiement"

exit 0

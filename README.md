# 🎓 Projet de Gestion des PFE

Une application web développée en Laravel pour faciliter la gestion des Projets de Fin d'Études dans un établissement universitaire.

## 📋 Description

Cette application permet :

- Aux étudiants de soumettre leurs propositions de PFE
- Aux encadrants de valider ou refuser les projets
- À l'administration de gérer les utilisateurs, les sujets et le suivi
- D'attribuer les encadrants aux projets
- De suivre l'état d'avancement de chaque PFE

## 🚀 Fonctionnalités principales

- Authentification (étudiant, encadrant, administrateur)
- Soumission et validation des sujets
- Attribution des projets
- Tableau de bord personnalisé


## 🛠️ Technologies utilisées

- Laravel 10.x
- PHP 8.1+
- PgAdmin 9 
- Blade
- Bootstrap / Tailwind CSS
- Composer & NPM

## ⚙️ Installation
Installer les dépendances PHP et JS :

*composer install
*npm install && npm run dev


Configurer l’environnement :

cp .env.example .env
php artisan key:generate


Configurer la base de données dans .env puis exécuter :

php artisan migrate --seed
Démarrer le serveur local :

php artisan serve
Accès via http://localhost:8000


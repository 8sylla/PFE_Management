# 🎓 PFE Management Platform – ENSAT Tanger

> Plateforme web intelligente pour la gestion centralisée des Projets de Fin d’Études à l’ENSA Tanger.

![Banner](https://yourdomain.com/banner.jpg) <!-- Remplacez par une bannière si vous en avez une -->

---

## 🗂️ Sommaire

- [🎯 Vision du Projet](#🎯-vision-du-projet)
- [👥 Fonctionnalités par Rôle](#👥-fonctionnalités-par-rôle)
- [🏗️ Architecture & Technologies](#🏗️-architecture--technologies)
- [⚙️ Guide d'Installation Rapide](#⚙️-guide-dinstallation-rapide)
- [🔑 Accès & Comptes de Test](#🔑-accès--comptes-de-test)
- [🧠 IA & Perspectives Futures](#🧠-ia--perspectives-futures)
- [🧾 Auteurs & Encadrement](#🧾-auteurs--encadrement)

---

## 🎯 Vision du Projet

**Objectif :** Optimiser la gestion des PFE par une solution numérique centralisée.

✅ *Problèmes ciblés :*  
- Perte d'informations  
- Lenteur administrative  
- Suivi difficile des étapes de PFE

🎯 *Notre ambition :*
- 🧠 Fiabiliser le processus
- ⏱️ Gagner du temps
- 🎓 Mieux guider les étudiants
- 🗂️ Constituer un historique numérique durable

---

## 👥 Fonctionnalités par Rôle

### 👨‍🎓 Étudiants
- 🧭 **Timeline interactive** du projet
- 📝 Soumission et suivi de la fiche PFE
- 📁 Dépôt de documents : rapports, présentations...
- 📆 Consultation des plannings & notes

---

### 👩‍🏫 Encadrants
- 📊 Tableau de bord de suivi
- ✅ Validation/Refus de fiches PFE
- 📂 Accès centralisé aux documents étudiants

---

### 👨‍💼 Administrateurs
- 📈 Dashboard global
- 👤 CRUD des comptes enseignants
- 🗓️ Planification des soutenances
- 🧮 Attribution des notes finales

---

## 🏗️ Architecture & Technologies

**🧱 Backend :**  
- Laravel 10 (PHP 8.1+)  
- MVC Pattern  
- Authentification multi-role via Guards

**🗃️ Base de Données :**  
- MySQL ou PostgreSQL

**🎨 Frontend :**  
- Blade (serveur)  
- Tailwind CSS (Espace Étudiant)  
- AdminLTE 3 (Admin & Enseignant)

**🛠️ Outils :**  
- `composer`, `npm`  
- `laravel-dompdf` (export PDF)

---

## ⚙️ Guide d'Installation Rapide

### 1. 🔧 Prérequis

- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

---

### 2. 🧬 Clonage & Installation

```bash
git clone https://github.com/rmss00-2synf/PFE_Management.git
cd PFE_Management
composer install
npm install
npm run dev
````

---

### 3. ⚙️ Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Configurez ensuite `.env` pour la base de données.

---

### 4. 🛢️ Migration & Seed

```bash
php artisan migrate:fresh --seed
```

---

### 5. 🔗 Lien de Stockage

```bash
php artisan storage:link
```

---

### 6. ▶️ Lancement du Serveur

```bash
php artisan serve
```

> Accédez à l'application via : [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔑 Accès & Comptes de Test

| Rôle           | URL de Connexion        | Email                                                     | Mot de Passe |
| -------------- | ----------------------- | --------------------------------------------------------- | ------------ |
| Administrateur | `/admin/login`          | [admin.pfe@uae.ac.ma](mailto:admin.pfe@uae.ac.ma)         | password     |
| Enseignant     | `/teacher/login`        | [nadia.elfassi@uae.ac.ma](mailto:nadia.elfassi@uae.ac.ma) | password     |
| Étudiant       | `/login` ou `/register` | (email `@etu.uae.ac.ma`)                                  | password     |

---

## 🧠 IA & Perspectives Futures

**🔍 Analyse Automatique de Fiche PFE**

> Évaluation de la clarté, faisabilité et pertinence technique du sujet.

**📌 Suggestion d’Encadrants**

> IA sémantique pour matcher sujet & spécialité des enseignants.

**🗓️ Assistant de Planification**

> Génération de planning optimal pour les soutenances en tenant compte de toutes les contraintes (jury, salle, encadrant).

---

## 🧾 Auteurs & Encadrement

Ce projet a été réalisé dans le cadre du PFE 2023-2024 à l’ENSA Tanger par :

* **SYLLA N'Faly**
* **SOUHAIL Chaiberras**
* **EL MEHDI El Ednani**

🎓 *Encadré par le Pr. Hassan BADIR*

---

> © ENSA Tanger – Génie Informatique – 2024/2025



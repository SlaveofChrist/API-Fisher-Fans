# API-Fisher-Fans
🐟 Fisher Fans API — API RESTful développée dans le cadre du projet de groupe pour le module Web Services 2 (M2 Informatique 2025-2026). Application fictive permettant aux passionnés de pêche en mer de partager des sorties, réserver des bateaux et gérer leur journal de pêche.

## 📋 Description du Projet

Cette API RESTful est construite avec **Laravel 12** et propose les fonctionnalités suivantes :
- Gestion des utilisateurs (authentification via Sanctum)
- Gestion des sorties de pêche (Trips)
- Réservation de bateaux (Bookings)
- Journaux de pêche avec pages détaillées (Fishing Logs)
- Gestion des bateaux (Boats)

## ⚙️ Prérequis

Avant de commencer, assurez-vous d'avoir installé :
- **PHP 8.2+** ([Télécharger](https://www.php.net/downloads.php))
- **Composer** ([Télécharger](https://getcomposer.org/))
- **Node.js 18+** avec npm ([Télécharger](https://nodejs.org/))
- **Git** ([Télécharger](https://git-scm.com/))

## 🚀 Installation et Démarrage Rapide

### Option 1 : Installation Automatique (Recommandée)

Exécutez la commande suivante pour installer complètement le projet :

```bash
composer run-script setup
```

Cette commande effectue automatiquement :
- ✅ Installation des dépendances Composer (`composer install`)
- ✅ Création du fichier `.env` depuis `.env.example`
- ✅ Génération de la clé d'application Laravel (`artisan key:generate`)
- ✅ Création et migration de la base de données SQLite (`artisan migrate`)
- ✅ Installation des dépendances npm (`npm install`)
- ✅ Compilation des assets (`npm run build`)

Après l'installation, démarrez le serveur :

```bash
composer run-script dev
```

### Option 2 : Installation Manuelle

Si vous préférez une installation étape par étape :

#### 1. Cloner le projet (si ce n'est pas déjà fait)
```bash
git clone <url-du-repo>
cd API-Fisher-Fans
```

#### 2. Installer les dépendances PHP
```bash
composer install
```

#### 3. Configurer l'environnement
```bash
# Copier le fichier d'exemple
copy .env.example .env

# Générer la clé de l'application (Windows)
php artisan key:generate
```

#### 4. Initialiser la base de données
```bash
# Créer et migrer la base de données SQLite
php artisan migrate

# (Optionnel) Remplir avec des données de test
php artisan db:seed
```

#### 5. Installer les dépendances Front-end
```bash
npm install
```

#### 6. Démarrer le serveur de développement

Pour lancer le serveur Laravel :
```bash
php artisan serve
```

Pour compiler les assets avec Vite en mode développement (dans un autre terminal) :
```bash
npm run dev
```

Ou pour démarrer tous les services en parallèle (recommandé) :
```bash
composer run-script dev
```

## 🌐 Accès à l'Application

Une fois le serveur démarré, l'API est accessible à :
- **URL locale** : `http://localhost:8000`
- **API Endpoint** : `http://localhost:8000/api`

## 📚 Structure du Projet

```
├── app/
│   ├── Http/Controllers/        # Contrôleurs API
│   │   ├── AuthController.php
│   │   ├── UserController.php
│   │   ├── TripController.php
│   │   ├── BookingController.php
│   │   ├── BoatController.php
│   │   ├── FishingLogController.php
│   │   └── FishingLogPageController.php
│   └── Models/                   # Modèles de données
│       ├── User.php
│       ├── Trip.php
│       ├── Booking.php
│       ├── Boat.php
│       ├── FishingLog.php
│       └── FishingLogPage.php
├── database/
│   ├── migrations/              # Migrations de schéma BD
│   ├── seeders/                 # Semences de données
│   └── factories/               # Factories pour les tests
├── routes/
│   ├── api.php                  # Routes de l'API
│   ├── web.php                  # Routes web
│   └── console.php              # Commandes console
├── resources/
│   ├── js/                      # JavaScript (Bootstrap)
│   └── css/                     # Styles (Tailwind CSS)
├── tests/                       # Tests unitaires et fonctionnels
├── config/                      # Fichiers de configuration
└── storage/                     # Fichiers temporaires et logs
```

## 🗄️ Base de Données

Le projet utilise **SQLite** par défaut pour faciliter le développement local.

### Fichier de configuration
Le fichier `.env` contient :
```
DB_CONNECTION=sqlite
```

### Migrations disponibles
- `0001_01_01_000000_create_users_table` - Table utilisateurs
- `2025_12_17_130754_create_trips_table` - Table sorties de pêche
- `2025_12_17_130813_create_bookings_table` - Table réservations
- `2025_12_17_130828_create_boats_table` - Table bateaux
- `2025_12_17_130859_create_fishing_logs_table` - Table journaux de pêche
- `2025_12_17_140815_create_fishing_log_pages_table` - Table pages de journal

## 🧪 Tests

Exécuter les tests unitaires et fonctionnels :

```bash
php artisan test
```

Ou avec PHPUnit directement :
```bash
./vendor/bin/phpunit
```

## 🛠️ Commandes Artisan Utiles

```bash
# Voir toutes les routes disponibles
php artisan route:list

# Créer un contrôleur
php artisan make:controller NomController

# Créer un modèle avec migration
php artisan make:model NomModele -m

# Créer une migration
php artisan make:migration create_table_name

# Lister les migrations
php artisan migrate:status

# Revenir en arrière (annuler la dernière migration)
php artisan migrate:rollback

# Réinitialiser la base de données
php artisan migrate:refresh

# Vider le cache
php artisan cache:clear

# Vider les logs
php artisan logs:clear
```

## 📖 Documentation API

La documentation OpenAPI est disponible dans les fichiers :
- `fisherfans-openapi-min.yaml` - Spécification API complète
- `paths-components.yaml` - Composants et chemins détaillés

## 🔐 Authentification

L'API utilise **Laravel Sanctum** pour l'authentification par tokens.

Pour obtenir un token :
```php
// Dans une route de test
$user = User::first();
$token = $user->createToken('token-name')->plainTextToken;
```

Utiliser le token dans les requêtes :
```
Authorization: Bearer <votre-token>
```

## 📦 Dépendances Principales

### PHP
- **Laravel 12** - Framework web
- **Laravel Sanctum** - Authentification API
- **Laravel Tinker** - REPL interactif
- **PHPUnit 11** - Tests
- **Faker** - Génération de données de test
- **Pint** - Formatage de code

### JavaScript
- **Vite 7** - Bundler et dev server
- **Tailwind CSS 4** - Framework CSS
- **Axios** - Client HTTP
- **Concurrently** - Exécuteur de tâches parallèles

## 🧹 Formatage du Code

Formater le code PHP avec Pint :
```bash
./vendor/bin/pint
```

## 💾 Fichiers de Configuration Importants

- `.env` - Variables d'environnement
- `config/app.php` - Configuration de l'application
- `config/database.php` - Configuration de la base de données
- `config/auth.php` - Configuration de l'authentification
- `config/cache.php` - Configuration du cache
- `phpunit.xml` - Configuration PHPUnit
- `vite.config.js` - Configuration Vite

## ⚠️ Dépannage

### Erreur : "No application encryption key has been generated"
```bash
php artisan key:generate
```

### Erreur : "Database does not exist"
```bash
php artisan migrate
```

### Erreur : "Class not found"
```bash
composer dump-autoload
```

### Effacer le cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📝 Notes

- Le projet utilise SQLite, idéal pour le développement. Pour la production, modifier `DB_CONNECTION` dans `.env`
- Les assets (CSS/JS) sont compilés avec Vite et Tailwind CSS
- Les emails sont envoyés en logs en développement (`MAIL_MAILER=log`)
- Les sessions sont stockées en base de données par défaut

## 👥 Équipe

Projet réalisé dans le cadre du module Web Services 2 - M2 Informatique 2025-2026

## 📄 Licence

MIT

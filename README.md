# MathIndex

**MathIndex** est un projet de fin d'année BTS SIO, développé en utilisant le framework **Symfony**. Ce projet vise à fournir une plateforme éducative axée sur les mathématiques, facilitant la gestion des exercices, des cours et des évaluations pour les étudiants et les enseignants.

## Stack

- **Backend** : Symfony 7.4 (PHP 8.4), Doctrine ORM, PostgreSQL 16
- **Frontend** : Webpack Encore, Sass, Stimulus/Turbo
- **Upload de fichiers** : VichUploaderBundle
- **Docker** : PHP-FPM + Nginx, images séparées pour le développement et la production (voir [CLAUDE.md](CLAUDE.md))

## Identifiants de développement

Ces comptes sont créés par `make fixtures` (jeu de données de développement uniquement — **jamais utilisés en production**) :

| Email                  | Mot de passe    | Rôle          |
|-------------------------|-----------------|---------------|
| admin@gmail.com          | AdminPassword   | ROLE_ADMIN    |
| teacherM@gmail.com       | compteTeacherM  | ROLE_TEACHER  |
| student@gmail.com        | compteStudent   | ROLE_STUDENT  |

(voir `src/DataFixtures/UserFixtures.php` pour la liste complète)

## Démarrage rapide (Docker, développement)

Prérequis : Docker Desktop.

```bash
make install   # build les images, démarre toute la stack (dont le watcher d'assets), migre la base, charge les fixtures
```

- **Application** : http://localhost:8080
- **PostgreSQL** exposé sur `localhost:5432` (utilisateur/mot de passe : voir `.env.docker`)

## Commandes utiles

| Commande | Effet |
|---|---|
| `make install` | Build + démarre la stack dev, migre la base, charge les fixtures |
| `make up` | Démarre la stack dev |
| `make down` | Arrête la stack dev |
| `make dcu` | Arrête, reconstruit et relance la stack dev |
| `make bash` | Ouvre un shell dans le conteneur PHP |
| `make logs` | Suit les logs de tous les services |
| `make fixtures` | Recharge les fixtures |
| `make migrate` | Applique les migrations en attente |
| `make migration` | Génère une migration à partir des changements d'entités |
| `make prod-build` / `make prod-up` / `make prod-down` | Équivalents pour la stack de production (voir CLAUDE.md pour les secrets requis) |

Voir `make help` pour la liste complète, et [CLAUDE.md](CLAUDE.md) pour l'architecture Docker détaillée (dev vs prod) et les variables d'environnement requises.

## Installation sans Docker

1. Installer les dépendances : `composer install`
2. Copier `.env` en `.env.local` et adapter `DATABASE_URL` vers votre PostgreSQL local
3. Compiler les assets :
   ```bash
   npm install
   npm run watch
   ```
4. Base de données :
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   php bin/console doctrine:fixtures:load
   ```
5. Lancer le serveur : `symfony server:start` (ou `php -S 127.0.0.1:8000 -t public`)

## Gestion des fichiers avec VichUploaderBundle

MathIndex utilise **VichUploaderBundle** pour gérer l'upload et le stockage de fichiers (documents d'exercices et corrections). Les uploads sont restreints aux PDF et images (voir `App\Entity\File`) et servis via `public/fichier/`.

## Auteurs

- **Romain**
- **Killian D**
- **Killian O**
- **Alexandre**

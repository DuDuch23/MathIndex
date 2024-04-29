# MathIndex

**MathIndex** est un projet de fin d'année BTS SIO, développé en utilisant le framework **Symfony**. Ce projet vise à fournir une plateforme éducative axée sur les mathématiques, facilitant la gestion des exercices, des cours et des évaluations pour les étudiants et les enseignants.

## Identifiants

Pour accéder à différentes parties de l'application, voici les identifiants par défaut :

| Email                    | Mot de passe | Rôles           |
|--------------------------|--------------|-----------------|
| jane.s@example.com       | password2    | ROLE_ADMIN      |
| john.d@gmail.com         | password1    | ROLE_CONTRIBUTEUR |

## Commandes Utiles

Pour simplifier la gestion du projet, vous pouvez utiliser les commandes suivantes :

- `make install` : Installe toutes les dépendances, configure la base de données, exécute les migrations et charge les fixtures.
- `make dcu` : Arrête, supprime et relance les conteneurs Docker pour redémarrer le projet.
- `make fixtures` : Charge les fixtures dans la base de données.
- `make bash` : Ouvre un terminal bash dans le conteneur Symfony.

## Gestion des fichiers avec VichUploaderBundle

MathIndex utilise **VichUploaderBundle** pour gérer l'upload et le stockage de fichiers. Ce bundle intégré avec Symfony permet de simplifier la gestion des fichiers attachés aux entités, comme les documents d'exercices et les corrections, en automatisant le processus d'upload et en fournissant un accès facile aux fichiers stockés.

## Installation avec Docker

Pour utiliser Docker dans votre environnement de développement :

1. Installez Docker sur votre machine.
2. Lancez le projet en exécutant `make install` à la racine du projet.

### Initialisation détaillée avec Docker

- Lancez tous les conteneurs avec `docker compose up`.
- Accédez au terminal du conteneur Symfony avec `docker compose exec symfony bash` et exécutez :
  - `composer install`
  - `php bin/console doctrine:database:create`
  - `php bin/console doctrine:schema:update --force`
  - `php bin/console doctrine:fixtures:load -n`
- Pour les assets, dans le conteneur Node : 
  - `docker compose exec node npm run dev`

## Installation sans Docker

Si vous préférez une installation locale sans Docker :

1. Installez les dépendances avec `composer install`.
2. Compilez les fichiers Sass :
   - `npm init`
   - `npm install`
   - `npm run watch`
3. Gérez la base de données :
   - `symfony console doctrine:database:create`
   - `symfony console doctrine:schema:update`
   - `symfony console doctrine:fixtures:load`

## Accès au projet

- **Application Web** : `http://127.0.0.1:8001`
- **Base de données** (via phpMyAdmin) : `http://127.0.0.1:8888`

## Auteurs

- **Romain**
- **Killian D**
- **Killian O**
- **Alexandre**
